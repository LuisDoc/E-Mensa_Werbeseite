create table Bewertung (
    id bigint(20) PRIMARY KEY AUTO_INCREMENT,
    user_id bigint(20),
    gericht_id bigint(20),
    bemerkung varchar(300),
    bewertung Integer,
    highlighted boolean default 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) References benutzer(id),
    FOREIGN KEY (gericht_id) References gericht(id)
);