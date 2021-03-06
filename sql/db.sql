CREATE DATABASE medical_test;

CREATE TABLE auth (
  id INTEGER NOT NULL AUTO_INCREMENT PRIMARY KEY,
  email VARCHAR(64) UNIQUE NOT NULL,
  password VARCHAR(64) NOT NULL
);

CREATE TABLE users (
  uid INTEGER NOT NULL,
  name VARCHAR(128),
  dob VARCHAR(10),
  age INTEGER,
  gender ENUM("Male","Female","Transgender"),
  mobile VARCHAR(10),
  address VARCHAR(256),
  CONSTRAINT FOREIGN KEY (uid) REFERENCES auth (id) ON DELETE CASCADE
);

CREATE TABLE tests (
  tid INTEGER NOT NULL AUTO_INCREMENT PRIMARY KEY,
  test_code VARCHAR(8) NOT NULL,
  test_name VARCHAR(64) NOT NULL,
  fee INTEGER NOT NULL,
  bio_ref_interval VARCHAR(16) NOT NULL,
  units VARCHAR(8) NOT NULL
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

CREATE TABLE tests_conducted (
  test_no INTEGER NOT NULL AUTO_INCREMENT PRIMARY KEY,
  user_id INTEGER NOT NULL,
  test_id INTEGER NOT NULL,
  date_and_time DATETIME NOT NULL,
  results VARCHAR(8) NOT NULL,
  order_id VARCHAR(24) NOT NULL,
  payment_id VARCHAR(24) NOT NULL,
  CONSTRAINT FOREIGN KEY (user_id) REFERENCES users (uid) ON DELETE CASCADE,
  CONSTRAINT FOREIGN KEY (test_id) REFERENCES tests (tid) ON DELETE CASCADE
);
