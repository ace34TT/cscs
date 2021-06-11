-- ALTER TABLE  results
-- ADD COLUMN note DOUBLE NOT NULL AFTER candidate; 

-- ALTER TABLE results
-- ADD stat BOOLEAN DEFAULT false NOT NULL;
-- DELETE from `events` ;
-- -- RENAME TABLE pretest_candidate_assignment TO test_candidate_assignment ;Add
-- ALTER TABLE comments
-- ADD COLUMN events INT UNSIGNED NOT NULL;
-- AFTER candidate;
-- ALTER TABLE comments DROP COLUMN events;
-- select *
-- from comments
-- where events not in (
--         select distinct id
--         from events
--     );
ALTER TABLE comments
ADD FOREIGN KEY (events) REFERENCES events(id);
-- ALTER TABLE (comments)
-- ADD FOREIGN KEY events REFERENCES events(id);
-- DROP TABLE pretest_results;
-- CREATE TABLE `posts` (
--     `id` INT unsigned NOT NULL AUTO_INCREMENT,
--     `name` VARCHAR (255) NOt NULL,
--     `category` VARCHAR (255) NOt NULL,
--     `quota` INT NOT NULL,
--     `created_date` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
--     PRIMARY KEY (`id`)
-- ) ENGINE = InnoDB AUTO_INCREMENT = 2 DEFAULT CHARSET = utf8mb4;
-- ALTER TABLE events
-- ADD COLUMN stat BOOLEAN DEFAULT FALSE NOT NULL;
CREATE VIEW users AS
SELECT candidates.id as users,
    personnal_informations.firstname,
    personnal_informations.lastname,
    personnal_informations.gender,
    personnal_informations.date_of_birth,
    personnal_informations.height,
    personnal_informations.weights,
    personnal_informations.province,
    personnal_informations.addresses,
    personnal_informations.phone,
    personnal_informations.email,
    personnal_informations.post,
    personnal_informations.reg_date
FROM personnal_informations
    INNER JOIN candidates ON candidates.personnal_information = personnal_informations.id;
-- UPDATE `pendings`
-- SET stat = FALSE;
-- DELETE from `personnal_informations`;
-- CREATE TABLE `pretest_results` (
--     `id` INT unsigned NOT NULL AUTO_INCREMENT,
--     `events` INT UNSIGNED NOT NULL,
--     `candidate` INT UNSIGNED NOt NULL,
--     `result` BOOLEAN NOT NULL DEFAULT 0,
--     PRIMARY KEY (`id`),
--     FOREIGN KEY (events) REFERENCES events(id),
--     FOREIGN KEY (candidate) REFERENCES candidates(id)
-- ) ENGINE = InnoDB AUTO_INCREMENT = 2 DEFAULT CHARSET = utf8mb4;
-- SELECT *
-- FROM personnal_informations
--     INNER JOIN candidates ON candidates.personnal_information = personnal_informations.id
--     INNER JOIN pending_pretests ON candidates.id = pending_pretests.candidate
-- WHERE pending_pretests.stat = false
-- ALTER TABLE `personnal_informations`
-- MODIFY `email` VARCHAR(75) UNIQUE NOT NULL;
-- DELETE FROM `personnal_informations` WHERE id = 21 ;
CREATE VIEW results_view AS
SELECT candidates.id as users,
    personnal_informations.firstname,
    personnal_informations.lastname,
    personnal_informations.post,
    results.events,
    results.note ,
    results.result,
    results.stat,
    results.created_date,
    events.events as types
FROM results
    INNER JOIN candidates ON results.candidate = candidates.id 
    INNER JOIN personnal_informations ON candidates.personnal_information = personnal_informations.id
    INNER JOIN events ON results.events = events.id ;
-- Select count(*) from results_view where result = 1
-- INSERT INTO admins(names, email, passwords)
-- VALUES (
--         'Mampionona Tsiky Kezia',
--         'kezia@cscsmadagascar.mg',
--         '7c59b57991d55631c7b18c1fb082af0e5bb00852'
--     );
-- -- 
-- SELECT *
-- FROM users
--     INNER JOIN results ON users.users = results.candidate
--     INNER JOIN events ON results.events = events.id
-- WHERE events.events = 'pretest'
--     AND results.result = 1;