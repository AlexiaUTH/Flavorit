--
-- Insertion de nouveaux utilisateurs
-- 
INSERT INTO user (user_mail, user_pwd, user_role, user_created_at) 
VALUES 
    ("philippe.enderlin@uha.fr", "$2y$10$LKMBKKJfDtOW9EP7WsrCTeYgNmzKbYN4b71P1OdI/82uPaJRxD/rm", "superadmin", NOW()),
    ("alexia.uthayakumaran@uha.fr", "$2y$10$LKMBKKJfDtOW9EP7WsrCTeYgNmzKbYN4b71P1OdI/82uPaJRxD/rm", "admin", NOW()),
    ("jerome.blondeau@uha.fr", "$2y$10$LKMBKKJfDtOW9EP7WsrCTeYgNmzKbYN4b71P1OdI/82uPaJRxD/rm", "user", NOW()),
    ("mohamed.azougagh@uha.fr", "$2y$10$wAQlI4EXEl1WHAsDFEP./utkyi2uTDEUU/ekx/l70hgMasAWqLIJW", "admin", NOW());