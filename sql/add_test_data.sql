-- Lisää INSERT INTO lauseet tähän tiedostoon

INSERT INTO Tutkija (kayttajatunnus, salasana) VALUES ('testi', 'testi');
INSERT INTO Tutkija (kayttajatunnus, salasana) VALUES ('tutkija', 'salasana');
INSERT INTO Tutkija (kayttajatunnus, salasana) VALUES ('tutkija2', 'abc123');



INSERT INTO Kohde (nimi, paikkakunta) VALUES ('Nuuksion Pitkäjärvi', 'Espoo');
INSERT INTO Kohde (nimi, paikkakunta) VALUES ('Aulangonjärvi', 'Hämeenlinna');


INSERT INTO Tutkimus (kohdeid, tutkijaid, paivamaara, aistivarainen_tieto, mittaustieto) VALUES
            (1, 1, '2010-10-10', 'Sään kuvaus', 'Lämpötila 12 astetta');
INSERT INTO Tutkimus (kohdeid, tutkijaid, paivamaara, aistivarainen_tieto, mittaustieto) VALUES
            (2, 1, '2011-04-01', 'Veden väri', 'Lämpötila 12 astetta. Veden lämpötila: 2 astetta');
INSERT INTO Tutkimus (kohdeid, tutkijaid, paivamaara, aistivarainen_tieto, mittaustieto) VALUES
            (1, 1, '2012-06-03', 'Veden väri', 'Lämpötila 12 astetta. Veden lämpötila: 2 astetta');
INSERT INTO Tutkimus (kohdeid, tutkijaid, paivamaara, aistivarainen_tieto, mittaustieto) VALUES
            (2, 1, '2015-02-13', 'Lumitilanne', 'Lämpötila 0 astetta');


INSERT INTO Nayte (tutkimusid, tutkijaid, nimi, kuvaus, analyysi, leveysaste, pituusaste, maamerkkitieto) VALUES (1, 1,'Happipitoisuus','Veden happipitoisuus','Analyysin tulos tulee tähän.', 60.25, 24.6, 'Koivu');
INSERT INTO Nayte (tutkimusid, tutkijaid, nimi, kuvaus, leveysaste, pituusaste, maamerkkitieto) VALUES (2, 1, 'pH','Veden pH-arvo', 61.0272, 24.4720, 'Kuusi');
INSERT INTO Nayte (tutkimusid, tutkijaid, nimi, kuvaus, leveysaste, pituusaste) VALUES (1, 1, 'pH','Veden pH-arvo', 60.25, 24.6);



