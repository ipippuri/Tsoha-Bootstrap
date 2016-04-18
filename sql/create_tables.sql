-- Lisää CREATE TABLE lauseet tähän tiedostoon

CREATE TABLE Tutkija(
    tutkijaid SERIAL PRIMARY KEY,
    kayttajatunnus varchar(30) UNIQUE NOT NULL,
    salasana varchar(20) NOT NULL
);

CREATE TABLE Kohde(
    kohdeid SERIAL PRIMARY KEY,
    nimi varchar(50) NOT NULL,
    paikkakunta varchar(50) NOT NULL
);

CREATE TABLE Tutkimus(
    tutkimusid SERIAL PRIMARY KEY,
    kohdeid integer REFERENCES Kohde(kohdeid) NOT NULL,
    tutkijaid integer REFERENCES Tutkija(tutkijaid),
    paivamaara date NOT NULL,
    aistivarainen_tieto text NOT NULL,
    mittaustieto text NOT NULL
);

CREATE TABLE Nayte(
    nayteid SERIAL PRIMARY KEY,
    tutkimusid integer REFERENCES Tutkimus(tutkimusid) NOT NULL,
    tutkijaid integer REFERENCES Tutkija(tutkijaid) NOT NULL,
    nimi varchar(50) NOT NULL,
    leveysaste decimal NOT NULL,
    pituusaste decimal NOT NULL,
    maamerkkitieto varchar(150),
    kuvaus text NOT NULL,
    analyysi text,
    CHECK (-90 < leveysaste AND leveysaste < 90),
    CHECK (-180 < pituusaste AND pituusaste < 180)
);