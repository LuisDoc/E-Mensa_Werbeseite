create table benutzer(
    id bigint primary key auto_increment,
    email varchar(100) not null unique,
    passwort varchar(200) not null,
    admin boolean default false,
    anzahlfehler int not null,
    anzahlanmeldungen int not null,
    letzteanmeldung datetime,
    letzterfehler datetime
);