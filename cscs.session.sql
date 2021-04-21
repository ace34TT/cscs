CREATE TABLE candidate (
    id INT(9) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(50) NOT NULL,
    passwords VARCHAR(40) NOT NULL,
    personnal_information INT NOT NULL,
    ADD FOREIGN KEY personnal_information REFERENCES personnal_informations(id)
)