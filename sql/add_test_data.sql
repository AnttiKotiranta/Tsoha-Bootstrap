-- Lisää INSERT INTO lauseet tähän tiedostoon
INSERT INTO Useeer (username, password) VALUES ('Testi', 'Testi123');
INSERT INTO Chore (useeer_id, name, description) VALUES (1, 'Testidataa', 'Kokeillaan toimiiko');
INSERT INTO Chore (useeer_id, name, description, priority) VALUES (1, 'Testidataa2', 'Kokeillaan toimiiko tää', 3);
INSERT INTO Label (name, description) VALUES ('LabelTest', 'Kokeillaan toimiiko');
INSERT INTO LabelChores (chore_id, label_id) VALUES (1, 1);

