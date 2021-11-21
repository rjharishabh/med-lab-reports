CREATE DATABASE medical_test;

CREATE TABLE auth (
  id INTEGER NOT NULL AUTO_INCREMENT PRIMARY KEY,
  email VARCHAR(64) UNIQUE NOT NULL,
  password VARCHAR(64) NOT NULL,
  token VARCHAR(64) NOT NULL
);

CREATE TABLE users (
  uid INTEGER NOT NULL AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(128),
  dob VARCHAR(10),
  age INTEGER,
  sex ENUM('M','F','N'),
  mobile VARCHAR(10),
  address VARCHAR(256),
  aid INTEGER NOT NULL,
  CONSTRAINT FOREIGN KEY (aid) REFERENCES auth (id) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE tests (
  tid INTEGER NOT NULL AUTO_INCREMENT PRIMARY KEY,
  test_code VARCHAR(8),
  test_name VARCHAR(64),
  fee INTEGER,
  bio_ref_interval VARCHAR(16),
  units VARCHAR(8)
);

INSERT INTO tests(test_code,test_name,fee,bio_ref_interval,units) VALUES ('GF', 'Glucose Fasting', 150, '70 - 100', 'mg/dL');
INSERT INTO tests(test_code,test_name,fee,bio_ref_interval,units) VALUES ('GPM', 'Glucose Post Meal', 120, '70 - 140', 'mg/dL');
INSERT INTO tests(test_code,test_name,fee,bio_ref_interval,units) VALUES ('TPT', 'Thyroid Profile Total', 250, '0.60 - 1.81', 'ng/mL');
INSERT INTO tests(test_code,test_name,fee,bio_ref_interval,units) VALUES ('HBN', 'Hemoglobin', 100, '13.00 - 17.00', 'g/dL');
INSERT INTO tests(test_code,test_name,fee,bio_ref_interval,units) VALUES ('RBC', 'RBC Count', 150, '4.50 - 5.50', 'mil/mm3');
INSERT INTO tests(test_code,test_name,fee,bio_ref_interval,units) VALUES ('PCV', 'Packed Cell Volume (PCV)', 80, '40.00 - 50.00', '%');
INSERT INTO tests(test_code,test_name,fee,bio_ref_interval,units) VALUES ('TLC', 'Total Leucocyte Count (TLC)', 200, '4.00 - 10.00', 'thou/mm3');
INSERT INTO tests(test_code,test_name,fee,bio_ref_interval,units) VALUES ('RDW', 'Red Cell Distribution Width (RDW)', 200, '11.60 - 14.00', '%');
INSERT INTO tests(test_code,test_name,fee,bio_ref_interval,units) VALUES ('MCV', 'Mean Corpuscular Volume (MCV)', 180, '83.00 - 101.00', 'fL');
INSERT INTO tests(test_code,test_name,fee,bio_ref_interval,units) VALUES ('MCH', 'Mean Corpuscular Hemoglobin (MCH)', 180, '27.00 - 32.00', 'pg');
INSERT INTO tests(test_code,test_name,fee,bio_ref_interval,units) VALUES ('MCHC', 'Mean Corpuscular Hemoglobin Concentration (MCHC)', 150, '31.50 - 34.50', 'g/dL');
INSERT INTO tests(test_code,test_name,fee,bio_ref_interval,units) VALUES ('PC', 'Platelet Count', 100, '150.00 - 410.00', 'thou/mm3');
INSERT INTO tests(test_code,test_name,fee,bio_ref_interval,units) VALUES ('TC', 'Total Cholesterol', 100, '<200.00', 'mg/dL');
INSERT INTO tests(test_code,test_name,fee,bio_ref_interval,units) VALUES ('HDLC', 'HDL Cholesterol', 80, '>40.00', 'mg/dL');
INSERT INTO tests(test_code,test_name,fee,bio_ref_interval,units) VALUES ('LDLC', 'LDL Cholesterol', 50, '<100.00', 'mg/dL');
