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
