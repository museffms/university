CREATE DATABASE university;
USE university;

CREATE TABLE IF NOT EXISTS estudio (
	id INT UNSIGNED NOT NULL AUTO_INCREMENT,
	nombre VARCHAR(255) NOT NULL DEFAULT 'nuevo estudio',
	PRIMARY KEY (id)
);

CREATE TABLE IF NOT EXISTS asignatura (
	id INT UNSIGNED NOT NULL AUTO_INCREMENT,
	nombre VARCHAR(255) NOT NULL DEFAULT 'nueva asignatura',
	id_estudio INT UNSIGNED NOT NULL,
	PRIMARY KEY (id),
	CONSTRAINT fk_id_estudio FOREIGN KEY (id_estudio) REFERENCES estudio(id)
);

CREATE TABLE IF NOT EXISTS profesor (
	id INT UNSIGNED NOT NULL AUTO_INCREMENT,
	nombre VARCHAR(255) NOT NULL DEFAULT 'nuevo profesor',
	PRIMARY KEY (id)
);

CREATE TABLE IF NOT EXISTS profesor_asignatura (
	id INT UNSIGNED NOT NULL AUTO_INCREMENT,
	id_profesor INT UNSIGNED NOT NULL,
	id_asignatura INT UNSIGNED NOT NULL,
	PRIMARY KEY (id),         
	CONSTRAINT fk_id_profesor FOREIGN KEY (id_profesor) REFERENCES profesor(id),
	CONSTRAINT fk_id_asignatura FOREIGN KEY (id_asignatura) REFERENCES asignatura(id)
);

INSERT INTO university.estudio (nombre) VALUES ('Matemáticas');
INSERT INTO university.estudio (nombre) VALUES ('Lengua extranjera');

INSERT INTO university.asignatura (nombre, id_estudio) VALUES ('Algebra',1);
INSERT INTO university.asignatura (nombre, id_estudio) VALUES ('Matemáticas avanzadas para la economía',1);
INSERT INTO university.asignatura (nombre, id_estudio) VALUES ('Francés nivel básico',2);
INSERT INTO university.asignatura (nombre, id_estudio) VALUES ('Francés nivel intermedio',2);
INSERT INTO university.asignatura (nombre, id_estudio) VALUES ('Inglés nivel básico',2);
INSERT INTO university.asignatura (nombre, id_estudio) VALUES ('Inglés nivel intermedio-avanzado',2);

INSERT INTO university.profesor (nombre) VALUES ('Andrés Pérez Luján');
INSERT INTO university.profesor (nombre) VALUES ('Luis Alberto García del Nido');
INSERT INTO university.profesor (nombre) VALUES ('François du Rocher');
INSERT INTO university.profesor (nombre) VALUES ('Michael Rooks');

INSERT INTO university.profesor_asignatura (id_profesor, id_asignatura) VALUES (1,1);
INSERT INTO university.profesor_asignatura (id_profesor, id_asignatura) VALUES (1,5);
INSERT INTO university.profesor_asignatura (id_profesor, id_asignatura) VALUES (2,2);
INSERT INTO university.profesor_asignatura (id_profesor, id_asignatura) VALUES (3,3);
INSERT INTO university.profesor_asignatura (id_profesor, id_asignatura) VALUES (3,4);
INSERT INTO university.profesor_asignatura (id_profesor, id_asignatura) VALUES (4,5);
INSERT INTO university.profesor_asignatura (id_profesor, id_asignatura) VALUES (4,6);
