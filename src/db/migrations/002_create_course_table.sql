CREATE TYPE course_category AS ENUM ('Inovation', 'Technology', 'Marketing' ,'Entrepreneurship', 'Agriculture');


CREATE TABLE course(
    id VARCHAR(255) PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    description TEXT,
    category course_category NOT NULL
    imageUrl TEXT
)