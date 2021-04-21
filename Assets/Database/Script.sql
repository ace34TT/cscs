CREATE TABLE candidates(
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(50) UNIQUE NOT NULL,
    passwords VARCHAR(40) NOT NULL,
    personnal_information INT UNSIGNED NOT NULL,
    FOREIGN KEY (personnal_information) REFERENCES personnal_informations(id)
) ENGINE = InnoDB AUTO_INCREMENT = 2 DEFAULT CHARSET = utf8mb4;