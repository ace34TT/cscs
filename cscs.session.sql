CREATE TABLE events (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    author VARCHAR(255) NOT NULL,
    responsible VARCHAR(255) NOT NULL,
    contact VARCHAR (13) NOT NULL,
    names VARCHAR (50) NOT NULL,
    events VARCHAR (15) NOT NULL,
    province VARCHAR (30) NOT NULL,
    place VARCHAR (255) NOT NULL,
    dates DATE NOT NULL,
    schedule TIME NOT NULL,
    descriptions TEXT (35535) NOT NULL,
)