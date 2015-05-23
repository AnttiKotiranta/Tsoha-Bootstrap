
CREATE TABLE Useeer(
user_id SERIAL PRIMARY KEY,
username varchar(20) unique not null,
password varchar(20) not Null
);

CREATE TABLE Chore(
id SERIAL PRIMARY KEY,
useeer_id INTEGER REFERENCES Useeer(user_id),
name varchar(20) not null,
description varchar(70),
priority integer DEFAULT 1,
deadline DATE,
done boolean DEFAULT false
);

CREATE TABLE Label(
id SERIAL PRIMARY KEY,
useeer_id INTEGER REFERENCES Useeer(user_id),
name varchar(20) not null,
description varchar(70)
);

CREATE TABLE LabelChores(
chore_id INTEGER REFERENCES Chore(id),
label_id INTEGER REFERENCES Label(id),
PRIMARY KEY (chore_id, label_id)
);
