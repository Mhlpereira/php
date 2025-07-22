CREATE TYPE team_category AS ENUM ('open', 'closed', 'archived');

CREATE TABLE teams(
    id VARCHAR(255) PRIMARY KEY,
    courseId VARCHAR(255) NOT NULL,
    title VARCHAR(255) NOT NULL,
    description TEXT,
    maxStudents INT NOT NULL,
    status team_category NOT NULL,
    startingDate TIMESTAMP NOT NULL,
    endingDate TIMESTAMP NOT NULL,
    FOREIGN KEY (courseId) REFERENCES course(id) ON DELETE CASCADE
)