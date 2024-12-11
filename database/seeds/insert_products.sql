--
-- Insertion de nouveaux produits
-- 
INSERT INTO `product` (`prod_name`, `prod_weight`, `prod_photo`, `prod_price`, `prod_desc`, `prod_updated_at`, `prod_cat_id`, `prod_bak_id`) VALUES
('Baguette', 100, 'loaf-2436370_1280.jpg', '1.20', 'Baguette tradition', '2024-07-02 20:21:11', 1, 1),
('Pain de campagne', 350, 'bread-4183225_1280.jpg', '3.00', 'Au seigle', '2024-07-02 20:23:33', 1, 1),
('Croissant', 25, 'croissant-6562091_1280.jpg', '1.10', 'Au beurre', '2024-07-02 20:34:29', 2, 1),
('Gâteau au chocolat et fruits rouges', 450, 'cake-8233676_1280.jpg', '25.00', 'Aux myrtille, framboise et figue', '2024-07-02 20:37:17', 3, 1),
('Club sandwich', 80, 'sandwich-8762913_1280.jpg', '5.50', 'Au jambon italien et &agrave; la feta', '2024-07-02 20:39:18', 4, 1),
('Chausson aux pommes', 50, 'bakery-4840780_1280.jpg', '2.10', 'Aux pommes et amandes grill&eacute;es', '2024-07-02 20:43:27', 2, 4),
('Cupcake au chocolat', 60, 'cupcakes-5116009_1280.jpg', '3.10', 'Cupcak aux <strong>3 chocolats</strong>', '2024-07-02 20:56:45', 3, 4),
('Croissant aux amandes', 40, 'dessert-6780813_1280.jpg', '1.80', 'Aux amandes <strong>Bio</strong>', '2024-07-02 20:56:19', 2, 4),
('Boule de pain', 120, 'loaf-7445434_1920.jpg', '4.80', 'Aux graines de s&eacute;same', '2024-07-02 20:58:20', 1, 4);