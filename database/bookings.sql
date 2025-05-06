CREATE TABLE bookings (
    id bigint PRIMARY KEY AUTO_INCREMENT,
    user_id bigint,
    service_type varchar(50),
    preferred_date date,
    preferred_time time,
    notes text,
    status varchar(20),
    created_at timestamp,
    updated_at timestamp
);

CREATE TABLE baptism_details (
    id bigint PRIMARY KEY AUTO_INCREMENT,
    booking_id bigint,
    child_name varchar(255),
    date_of_birth date,
    place_of_birth varchar(255),
    father_name varchar(255),
    mother_name varchar(255),
    nationality varchar(100),
    created_at timestamp,
    updated_at timestamp
);

CREATE TABLE wedding_details (
    id bigint PRIMARY KEY AUTO_INCREMENT,
    booking_id bigint,
    groom_name varchar(255),
    groom_age int,
    groom_religion varchar(100),
    bride_name varchar(255),
    bride_age int,
    bride_religion varchar(100),
    created_at timestamp,
    updated_at timestamp
);

CREATE TABLE mass_intention_details (
    id bigint PRIMARY KEY AUTO_INCREMENT,
    booking_id bigint,
    mass_type varchar(50),
    mass_names text,
    created_at timestamp,
    updated_at timestamp
);

CREATE TABLE blessing_details (
    id bigint PRIMARY KEY AUTO_INCREMENT,
    booking_id bigint,
    blessing_type varchar(50),
    blessing_location text,
    created_at timestamp,
    updated_at timestamp
);

CREATE TABLE confirmation_details (
    id bigint PRIMARY KEY AUTO_INCREMENT,
    booking_id bigint,
    confirmand_name varchar(255),
    confirmand_dob date,
    baptism_place varchar(255),
    baptism_date date,
    sponsor_name varchar(255),
    created_at timestamp,
    updated_at timestamp
);

CREATE TABLE sick_call_details (
    id bigint PRIMARY KEY AUTO_INCREMENT,
    booking_id bigint,
    patient_name varchar(255),
    patient_age int,
    patient_condition text,
    location varchar(255),
    room_number varchar(50),
    contact_person varchar(255),
    emergency_contact varchar(50),
    created_at timestamp,
    updated_at timestamp
);