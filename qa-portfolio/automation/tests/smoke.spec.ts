import { test, expect, type Page } from '@playwright/test';
import path from 'path';
import fs from 'fs';

const ADMIN_EMAIL = 'admin@garrison.com';
const ADMIN_PASSWORD = 'admin123';

function uniqueEmail(prefix: string) {
  return `${prefix}.${Date.now()}@example.com`;
}

async function signup(page: Page, name: string, email: string, password: string) {
  await page.goto('/signup.php');
  await page.getByLabel('Name').fill(name);
  await page.getByLabel('Email', { exact: true }).fill(email);
  await page.locator('#pwd').fill(password);
  await page.locator('#conf_pwd').fill(password);
  await page.getByRole('button', { name: 'Sign up' }).click();
  await expect(page.getByText('Registration successful')).toBeVisible();
}

async function login(page: Page, email: string, password: string) {
  await page.goto('/login.php');
  await page.locator('#email').fill(email);
  await page.locator('#pwd').fill(password);
  await page.getByRole('button', { name: 'Login' }).click();
}

test.describe('The Garrison — smoke', () => {
  test('home/login pages load', async ({ page }) => {
    const home = await page.goto('/index.php');
    expect(home?.ok()).toBeTruthy();
    const login = await page.goto('/login.php');
    expect(login?.ok()).toBeTruthy();
    await expect(page.getByRole('heading', { name: 'Login' })).toBeVisible();
  });

  test('customer can sign up and log in', async ({ page }) => {
    const email = uniqueEmail('customer');
    await signup(page, 'Smoke Customer', email, 'test123');
    await login(page, email, 'test123');
    await expect(page).toHaveURL(/index\.php/);
  });

  test('guest is redirected from reservation page', async ({ page }) => {
    await page.goto('/rezervare.php');
    await expect(page).toHaveURL(/login\.php/);
  });

  test('customer can create a future reservation', async ({ page }) => {
    const email = uniqueEmail('reserve');
    await signup(page, 'Reserve User', email, 'test123');
    await login(page, email, 'test123');
    await page.goto('/rezervare.php');
    await page.locator('#nr_persoane').fill('2');
    await page.locator('#data_rezervare').fill('2031-05-20');
    await page.getByRole('button', { name: 'Submit' }).click();
    await expect(page).toHaveURL(/index\.php/);
  });

  test('reservation rejects party size above 6', async ({ page }) => {
    const email = uniqueEmail('party');
    await signup(page, 'Party User', email, 'test123');
    await login(page, email, 'test123');
    await page.goto('/rezervare.php');
    await page.locator('#nr_persoane').fill('7');
    await page.locator('#data_rezervare').fill('2031-05-21');
    await page.getByRole('button', { name: 'Submit' }).click();
    await expect(page.getByText('Numarul maxim de persoane este 6')).toBeVisible();
  });

  test('admin can log in and open admin panel', async ({ page }) => {
    await login(page, ADMIN_EMAIL, ADMIN_PASSWORD);
    await expect(page).toHaveURL(/secure\.php/);
    await expect(page.getByRole('heading', { name: 'ADMIN' })).toBeVisible();
  });

  test('admin can add a menu item with valid price', async ({ page }) => {
    await login(page, ADMIN_EMAIL, ADMIN_PASSWORD);
    await page.goto('/add.php?categorie=starters');

    const pngPath = path.join(__dirname, 'fixtures', 'dot.png');
    fs.mkdirSync(path.dirname(pngPath), { recursive: true });
    if (!fs.existsSync(pngPath)) {
      // 1x1 PNG
      const buf = Buffer.from(
        'iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAYAAAAfFcSJAAAADUlEQVR42mP8z8BQDwAEhQGAhKmMIQAAAABJRU5ErkJggg==',
        'base64',
      );
      fs.writeFileSync(pngPath, buf);
    }

    await page.locator('#nume').fill(`Smoke Dish ${Date.now()}`);
    await page.locator('#pret').fill('12.50');
    await page.locator('#descriere').fill('Automated smoke item');
    await page.locator('#categorie').selectOption('starters');
    await page.locator('#file').setInputFiles(pngPath);
    await page.getByRole('button', { name: 'Submit' }).click();
    await expect(page).toHaveURL(/secure\.php/);
  });

  test('admin search page is reachable', async ({ page }) => {
    await login(page, ADMIN_EMAIL, ADMIN_PASSWORD);
    await page.goto('/search.php');
    await expect(page.getByRole('heading', { name: 'Cauta rezervare' })).toBeVisible();
    await expect(page.locator('#live_search')).toBeVisible();
  });

  test('login shows error for unknown email', async ({ page }) => {
    await login(page, 'missing.user@example.com', 'whatever');
    await expect(page.getByText('Email id not registered')).toBeVisible();
  });
});
