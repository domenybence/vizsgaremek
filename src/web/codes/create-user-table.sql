CREATE TABLE felhasznalok (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nev VARCHAR(100),
    email VARCHAR(100) UNIQUE,
    regisztracio_datum DATE
);
