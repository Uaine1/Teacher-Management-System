CREATE TABLE applicants (
    applicant_id INT AUTO_INCREMENT PRIMARY KEY,
    job_id INT,
    first_name VARCHAR(50),
    last_name VARCHAR(50),
    email VARCHAR(100),
    resume_url VARCHAR(255), 
    date_applied TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (job_id) REFERENCES job_posts(job_id) ON DELETE CASCADE
);

CREATE TABLE job_posts (
    job_id INT AUTO_INCREMENT PRIMARY KEY,
    job_title VARCHAR(100),
    job_description TEXT,
    date_posted TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    status VARCHAR(50) DEFAULT 'open',
    hired_user_id INT NULL
);

CREATE TABLE messages (
    message_id INT AUTO_INCREMENT PRIMARY KEY,
    sender_id INT,
    receiver_id INT,
    subject VARCHAR(255),
    message_text TEXT,
    date_sent TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    status ENUM('unread', 'read') DEFAULT 'unread'
);

CREATE TABLE teachers (
    teacher_id INT AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(50),
    last_name VARCHAR(50),
    email VARCHAR(50),
    gender VARCHAR(50),
    subject_specialty VARCHAR(50),
    employ_status VARCHAR(50),
    date_added TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);