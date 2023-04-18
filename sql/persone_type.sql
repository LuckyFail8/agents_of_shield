-- Active: 1665387775233@@127.0.0.1@3306@agents_of_shield
INSERT INTO agent (id_person)
SELECT (id)
FROM person
WHERE person_type = 'agent';
INSERT INTO target (id_person)
SELECT (id)
FROM person
WHERE person_type = 'target';
INSERT INTO contact (id_person)
SELECT (id)
FROM person
WHERE person_type = 'contact';