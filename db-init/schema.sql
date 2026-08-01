-- Schema pentru aplicatia The Garrison
-- Acest fisier ruleaza automat la prima pornire a containerului MySQL
-- (montat in /docker-entrypoint-initdb.d/), deci tabelele se creeaza singure.

CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(150) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    remember_token VARCHAR(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS admins (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(150) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    remember_token VARCHAR(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS meniu (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nume VARCHAR(150) NOT NULL,
    pret DECIMAL(10,2) NOT NULL,
    descriere TEXT,
    imagine VARCHAR(255),
    categorie ENUM('starters','breakfast','lunch','dinner') NOT NULL DEFAULT 'starters'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS mese (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nr_persoane INT NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS rezervari (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nume VARCHAR(150) NOT NULL,
    data_rezervare DATE NOT NULL,
    nr_persoane INT NOT NULL,
    id_masa INT NOT NULL,
    CONSTRAINT fk_rezervari_masa FOREIGN KEY (id_masa) REFERENCES mese(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Cateva mese de test, ca sistemul de rezervari sa aiba ce sa gaseasca
-- de la prima pornire (rezervare.php cauta in tabelul "mese")
INSERT INTO mese (nr_persoane) VALUES (2), (2), (4), (4), (6);
