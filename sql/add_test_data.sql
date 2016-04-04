-- Lisää INSERT INTO lauseet tähän tiedostoon

INSERT INTO Tutkija (kayttajatunnus, salasana) VALUES ('Tutkija1', 'Tutkija123');

INSERT INTO Kohde (nimi, paikkakunta) VALUES ('Nuuksion Pitkäjärvi', 'Espoo');
INSERT INTO Kohde (nimi, paikkakunta) VALUES ('Aulangonjärvi', 'Hämeenlinna');


INSERT INTO Naytteenottopaikka (kohdeid, leveysaste, pituusaste, maamerkkitieto) VALUES
            (1, 60.25, 24.6, 'Koivu');
INSERT INTO Naytteenottopaikka (kohdeid, leveysaste, pituusaste, maamerkkitieto) VALUES
            (2, 61.027257, 24.472031, 'Kuusi');


INSERT INTO Tutkimus (kohdeid, tutkijaid,paivamaara, aistivarainen_tieto, mittaustieto) VALUES
            (1, 1, '2010-10-10', 'Sään kuvaus', 'Lämpötila 12 astetta');
INSERT INTO Tutkimus (kohdeid, tutkijaid, paivamaara, aistivarainen_tieto, mittaustieto) VALUES
            (2, 1, '2011-04-01', 'Veden väri', 'Lämpötila 12 astetta. Veden lämpötila: 2 astetta');


INSERT INTO Nayte (n_id, tutkimusid, tutkijaid, nimi, kuvaus, analyysi) VALUES (1, 1, 1,'Happipitoisuus','Veden happipitoisuus','Analyysin tulos tulee tähän.');
INSERT INTO Nayte (n_id, tutkimusid, tutkijaid, nimi, kuvaus) VALUES (2, 2, 1, 'pH','Veden pH-arvo');



