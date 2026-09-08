/**
 * One-off screenshot capture for QA portfolio evidence.
 * Run: npx playwright test --config=playwright.config.ts ../scripts/capture-screens.mjs
 * Or: node with playwright programmatically.
 */
const { chromium } = require('playwright');
const path = require('path');
const fs = require('fs');

const BASE = process.env.BASE_URL || 'http://127.0.0.1:8080';
const OUT = path.join(__dirname, '../docs/screenshots');
const ART = '/opt/cursor/artifacts';

async function main() {
  fs.mkdirSync(OUT, { recursive: true });
  fs.mkdirSync(ART, { recursive: true });
  const browser = await chromium.launch();
  const page = await browser.newPage({ viewport: { width: 1280, height: 800 } });

  await page.goto(`${BASE}/login.php`);
  await page.screenshot({ path: path.join(OUT, 'login.png'), fullPage: false });
  await page.screenshot({ path: path.join(ART, 'qa-login.png'), fullPage: false });

  await page.goto(`${BASE}/signup.php`);
  await page.screenshot({ path: path.join(OUT, 'signup.png'), fullPage: false });
  await page.screenshot({ path: path.join(ART, 'qa-signup.png'), fullPage: false });

  await page.goto(`${BASE}/index.php`);
  await page.screenshot({ path: path.join(OUT, 'home.png'), fullPage: false });
  await page.screenshot({ path: path.join(ART, 'qa-home.png'), fullPage: false });

  // Admin login
  await page.goto(`${BASE}/login.php`);
  await page.locator('#email').fill('admin@garrison.com');
  await page.locator('#pwd').fill('admin123');
  await page.getByRole('button', { name: 'Login' }).click();
  await page.waitForURL(/secure\.php/);
  await page.screenshot({ path: path.join(OUT, 'admin.png'), fullPage: false });
  await page.screenshot({ path: path.join(ART, 'qa-admin.png'), fullPage: false });

  // BUG-009 add XSS evidence
  await page.goto(`${BASE}/add.php`);
  await page.locator('#nume').fill('"><img src=x onerror=alert(1)>');
  await page.locator('#descriere').fill('"><svg/onload=alert(2)>');
  await page.locator('#pret').fill('-5');
  await page.getByRole('button', { name: 'Submit' }).click();
  await page.waitForTimeout(500);
  await page.screenshot({ path: path.join(OUT, 'BUG-evidence-add-xss.png'), fullPage: false });
  await page.screenshot({ path: path.join(ART, 'qa-bug-add-xss.png'), fullPage: false });

  // Live search typo evidence — need keyup events (jQuery binds keyup, not input)
  await page.goto(`${BASE}/search.php`);
  await page.waitForTimeout(800);
  await page.locator('#live_search').click();
  await page.locator('#live_search').pressSequentially('QA', { delay: 80 });
  await page.waitForSelector('#searchresult table', { timeout: 10000 });
  await page.locator('#searchresult table').scrollIntoViewIfNeeded();
  await page.waitForTimeout(300);
  await page.screenshot({ path: path.join(OUT, 'BUG-evidence-persone.png'), fullPage: false });
  await page.screenshot({ path: path.join(ART, 'qa-bug-persone.png'), fullPage: false });

  // Past date blocked (customer)
  await page.goto(`${BASE}/logout.php`);
  await page.goto(`${BASE}/login.php`);
  await page.locator('#email').fill('qa.tester@example.com');
  await page.locator('#pwd').fill('test123');
  await page.getByRole('button', { name: 'Login' }).click();
  await page.waitForURL(/index\.php/);
  await page.goto(`${BASE}/rezervare.php`);
  await page.locator('#nr_persoane').fill('2');
  await page.locator('#data_rezervare').evaluate((el) => el.removeAttribute('min'));
  await page.locator('#data_rezervare').fill('2020-01-01');
  await page.getByRole('button', { name: 'Submit' }).click();
  await page.waitForTimeout(400);
  await page.screenshot({ path: path.join(OUT, 'BUG-evidence-past-blocked.png'), fullPage: false });
  await page.screenshot({ path: path.join(ART, 'qa-past-blocked.png'), fullPage: false });

  await browser.close();
  console.log('Screenshots written to', OUT, 'and', ART);
}

main().catch((e) => {
  console.error(e);
  process.exit(1);
});
