USE library_db;


CREATE TABLE authors (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255),
    biography TEXT,
    nationality VARCHAR(100),
    birth_date DATE
);


CREATE TABLE categories (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(100)
);


CREATE TABLE books (
    isbn VARCHAR(20) PRIMARY KEY,
    title VARCHAR(255),
    publication_year INT,
    category_id INT,
    status VARCHAR(50),
    FOREIGN KEY (category_id) REFERENCES categories(id)
);


CREATE TABLE book_author (
    book_isbn VARCHAR(20),
    author_id INT,
    PRIMARY KEY (book_isbn, author_id),
    FOREIGN KEY (book_isbn) REFERENCES books(isbn),
    FOREIGN KEY (author_id) REFERENCES authors(id)
);


CREATE TABLE branches (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(100),
    location VARCHAR(255)
);


CREATE TABLE inventory (
    branch_id INT,
    book_isbn VARCHAR(20),
    total_copies INT,
    available_copies INT,
    PRIMARY KEY (branch_id, book_isbn),
    FOREIGN KEY (branch_id) REFERENCES branches(id),
    FOREIGN KEY (book_isbn) REFERENCES books(isbn)
);


CREATE TABLE members (
    id INT PRIMARY KEY AUTO_INCREMENT,
    full_name VARCHAR(255),
    email VARCHAR(150),
    member_type ENUM('Student', 'Faculty') NOT NULL DEFAULT 'Student', 
    expiry_date DATE,
    unpaid_fees DECIMAL(10, 2) DEFAULT 0.00
);


CREATE TABLE borrow_records (
    id INT PRIMARY KEY AUTO_INCREMENT,
    member_id INT,
    book_isbn VARCHAR(20),
    branch_id INT,
    borrow_date DATE,
    due_date DATE,
    return_date DATE,
    late_fee DECIMAL(10, 2),
    FOREIGN KEY (member_id) REFERENCES members(id),
    FOREIGN KEY (book_isbn) REFERENCES books(isbn),
    FOREIGN KEY (branch_id) REFERENCES branches(id)
);

CREATE TABLE reservations (
    id INT PRIMARY KEY AUTO_INCREMENT,
    member_id INT,
    book_isbn VARCHAR(20),
    reservation_date DATE,
    status VARCHAR(50),
    FOREIGN KEY (member_id) REFERENCES members(id),
    FOREIGN KEY (book_isbn) REFERENCES books(isbn)
);