INSERT INTO authors (name, biography, nationality, birth_date) VALUES 
('Robert C. Martin', 'Uncle Bob is a software engineer and author.', 'American', '1952-12-05'),
('J.K. Rowling', 'Author of the Harry Potter series.', 'British', '1965-07-31'),
('Martin Fowler', 'Expert in software architecture and refactoring.', 'British', '1963-12-18'),
('George Orwell', 'Famous for dystopian novels like 1984.', 'British', '1903-06-25'),
('Andrew Hunt', 'Co-author of The Pragmatic Programmer.', 'American', '1964-01-01');

INSERT INTO categories (name) VALUES 
('Computer Science'),
('Fiction'),
('Science'),
('Literature'),
('History');

INSERT INTO books (isbn, title, publication_year, category_id, status) VALUES 
('978-0132350884', 'Clean Code', 2008, 1, 'Available'),
('978-0134757599', 'Refactoring', 2018, 1, 'Available'),
('978-0439064873', 'Harry Potter and the Chamber of Secrets', 1999, 2, 'Available'),
('978-0451524935', '1984', 1949, 4, 'Available'),
('978-0201616224', 'The Pragmatic Programmer', 1999, 1, 'Available');

INSERT INTO book_author (book_isbn, author_id) VALUES 
('978-0132350884', 1),
('978-0134757599', 3),
('978-0439064873', 2),
('978-0451524935', 4),
('978-0201616224', 5);

INSERT INTO branches (name, location) VALUES 
('North Campus Library', 'Building A, 1st Floor'),
('South Campus Library', 'Building C, Ground Floor'),
('TechCity Main', 'Downtown Plaza'),
('Science Center', 'Lab District'),
('West Wing', 'Student Union');

INSERT INTO inventory (branch_id, book_isbn, total_copies, available_copies) VALUES 
(1, '978-0132350884', 5, 5),
(1, '978-0134757599', 3, 3),
(2, '978-0439064873', 10, 10),
(3, '978-0451524935', 4, 4),
(1, '978-0201616224', 2, 2);

INSERT INTO members (full_name, email, member_type, expiry_date, unpaid_fees) VALUES 
('Alice Johnson', 'alice@university.edu', 'Student', '2026-06-30', 0.00),
('Dr. Bob Smith', 'bob.smith@university.edu', 'Faculty', '2028-12-31', 0.00),
('Charlie Davis', 'charlie@university.edu', 'Student', '2026-06-30', 5.50),
('Prof. Elena Ross', 'e.ross@university.edu', 'Faculty', '2029-01-15', 12.00),
('Frank Miller', 'frank@university.edu', 'Student', '2025-12-31', 0.00);