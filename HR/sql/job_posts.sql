CREATE TABLE job_posts (
    job_id INT AUTO_INCREMENT PRIMARY KEY,
    job_title VARCHAR(100),
    job_description TEXT,
    date_posted TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    status VARCHAR(50) DEFAULT 'open',
    hired_user_id INT NULL
);
