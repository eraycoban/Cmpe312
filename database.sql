DROP TABLE IF EXISTS users;

CREATE TABLE users (
  id int(15) DEFAULT NULL,
  username varchar(25),
  password varchar(25),
  PRIMARY KEY (id, username)
);



DROP TABLE IF EXISTS instructor;

CREATE TABLE instructor (
  i_id int(15) AUTO_INCREMENT DEFAULT NULL,
  f_name varchar(25),
  l_name varchar(25),
  department varchar(25),
  role varchar(25),
  id int(15),
  PRIMARY KEY (i_id),
  FOREIGN KEY (i_id) REFERENCES users(id)
);

DROP TABLE IF EXISTS student;

CREATE TABLE student (
  s_id int(15) AUTO_INCREMENT NOT NULL,
  f_name varchar(25),
  l_name varchar(25),
  department varchar(25),
  PRIMARY KEY (s_id),
  FOREIGN KEY (s_id) REFERENCES users(id)
);


DROP TABLE IF EXISTS course;

CREATE TABLE course (
  course_id int(15) AUTO_INCREMENT NOT NULL,
  course_title varchar(25),
  department varchar(25),
  credit_hours int(2),
  group_id int(5),
  PRIMARY KEY (course_id, group_id)
);

ALTER TABLE course ADD INDEX(group_id);
ALTER TABLE course ADD INDEX(course_id);




DROP TABLE IF EXISTS prereq;

CREATE TABLE prereq (
  course_id int(15) AUTO_INCREMENT NOT NULL,
  prereq_id int(15),
  semester_id int(5),
  PRIMARY KEY (course_id),
  FOREIGN KEY (course_id) REFERENCES course(course_id),
  FOREIGN KEY (prereq_id) REFERENCES course(course_id)
);



DROP TABLE IF EXISTS groups;

CREATE TABLE groups (
  group_id int(5) AUTO_INCREMENT NOT NULL,
  course_id int(15),
  day varchar(15),
  start_time varchar(25),
  end_time varchar(25),
  PRIMARY KEY (group_id, course_id, day),
  FOREIGN KEY (course_id) REFERENCES course(course_id),
  FOREIGN KEY (group_id) REFERENCES course(group_id)
);



DROP TABLE IF EXISTS section;

CREATE TABLE section (
  course_id int(15) AUTO_INCREMENT NOT NULL,
  sec_id int(15),
  semester int(5),
  year int(4),
  group_id int(5),
  PRIMARY KEY (course_id, sec_id, semester, year),
  FOREIGN KEY (course_id) REFERENCES course(course_id)
);

ALTER TABLE section ADD INDEX(sec_id);
ALTER TABLE section ADD INDEX(semester);
ALTER TABLE section ADD INDEX(year);


DROP TABLE IF EXISTS taken;

CREATE TABLE taken (
  s_id int(15) AUTO_INCREMENT NOT NULL,
  course_id int(15),
  sec_id int(15),
  semester int(5),
  year int(4),
  group_id int(5),
  status varchar(25),
  PRIMARY KEY (s_id, course_id, sec_id, semester, year),
  FOREIGN KEY (s_id) REFERENCES student(s_id),
  FOREIGN KEY (course_id) REFERENCES section(course_id),
  FOREIGN KEY (sec_id) REFERENCES section(sec_id),
  FOREIGN KEY (semester) REFERENCES section(semester),
  FOREIGN KEY (year) REFERENCES section(year)
);


DROP TABLE IF EXISTS teaches;

CREATE TABLE teaches (
  i_id int(15) AUTO_INCREMENT NOT NULL,
  course_id int(15),
  sec_id int(15),
  semester int(5),
  year int(4),
  PRIMARY KEY (i_id, course_id),
  FOREIGN KEY (i_id) REFERENCES instructor(i_id),
  FOREIGN KEY (course_id) REFERENCES section(course_id),
  FOREIGN KEY (sec_id) REFERENCES section(sec_id),
  FOREIGN KEY (semester) REFERENCES section(semester),
  FOREIGN KEY (year) REFERENCES section(year)
);



DROP TABLE IF EXISTS registers;

CREATE TABLE registers (
  s_id int(15) AUTO_INCREMENT NOT NULL,
  i_id int(15),
  selected_courses int(15),
  must_courses int(15),
  reg_status varchar(25),
  PRIMARY KEY (s_id, i_id),
  FOREIGN KEY (selected_courses) REFERENCES course(course_id),
  FOREIGN KEY (must_courses) REFERENCES course(course_id)
);



DROP TABLE IF EXISTS advises;

CREATE TABLE advises (
  s_id int(15) AUTO_INCREMENT NOT NULL,
  i_id int(15),
  confirmed varchar(3),
  PRIMARY KEY (s_id, i_id),
  FOREIGN KEY (s_id) REFERENCES student(s_id),
  FOREIGN KEY (i_id) REFERENCES instructor(i_id)
);



DROP TABLE IF EXISTS admin;

CREATE TABLE admin (
  a_id int(15) AUTO_INCREMENT NOT NULL,
  f_name varchar(25),
  l_name varchar(25),
  email varchar(25),
  PRIMARY KEY (a_id),
  FOREIGN KEY (a_id) REFERENCES users(id)
);
