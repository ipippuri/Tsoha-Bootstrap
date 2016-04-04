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

CREATE TABLE Naytteenottopaikka(
    n_id SERIAL PRIMARY KEY,
    kohdeid integer REFERENCES Kohde(kohdeid) NOT NULL,
    leveysaste decimal NOT NULL,
    pituusaste decimal NOT NULL,
    maamerkkitieto varchar(150),
    CHECK (-90 < leveysaste AND leveysaste < 90),
    CHECK (-180 < pituusaste AND pituusaste < 180)
);

CREATE TABLE Tutkimus(
    tutkimusid SERIAL PRIMARY KEY,
    kohdeid integer REFERENCES Kohde(kohdeid) NOT NULL,
    tutkijaid integer REFERENCES Tutkija(tutkijaid) NOT NULL,
    paivamaara date NOT NULL,
    aistivarainen_tieto text NOT NULL,
    mittaustieto text NOT NULL
);

CREATE TABLE Nayte(
    nayteid SERIAL PRIMARY KEY,
    n_id integer REFERENCES Naytteenottopaikka(n_id) NOT NULL,
    tutkimusid integer REFERENCES Tutkimus(tutkimusid) NOT NULL,
    tutkijaid integer REFERENCES Tutkija(tutkijaid) NOT NULL,
    nimi varchar(50) NOT NULL,
    kuvaus text NOT NULL,
    analyysi text
);