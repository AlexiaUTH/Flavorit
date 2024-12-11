-- 
-- Création de la base de données
--
CREATE DATABASE flavorit;

-- 
-- Utilisation de la base de données
--
USE flavorit;

--
-- Création des tables
-- 

/* Table category */
CREATE TABLE category (
	cat_id INT UNSIGNED NOT NULL AUTO_INCREMENT COMMENT "Identifiant de la catégorie",
	cat_name VARCHAR(255) NOT NULL COMMENT "Nom de la catégorie",
	PRIMARY KEY (cat_id)
) ENGINE=InnoDB;

/* Table product */
CREATE TABLE product (
	prod_id INT UNSIGNED NOT NULL AUTO_INCREMENT COMMENT "Identifiant du produit",
	prod_name VARCHAR(255) NOT NULL COMMENT "Libellé du produit",
	prod_weight INT NULL COMMENT "Poids du produit en grammes",
	prod_photo VARCHAR(255) NULL COMMENT "Photo du produit",
	prod_price DECIMAL(7,2) NOT NULL COMMENT "Prix du produit",
	prod_desc TEXT NOT NULL COMMENT "Description du produit",
	prod_updated_at DATETIME NULL COMMENT "Date de mise à jour du produit",
	prod_cat_id INT UNSIGNED COMMENT "Identifiant vers la catégorie",
	prod_bak_id INT UNSIGNED COMMENT "Identifiant de la boulangerie",
	PRIMARY KEY (prod_id),
	INDEX (prod_cat_id),
	INDEX (prod_bak_id)
) ENGINE=InnoDB;

/* Table city */
CREATE TABLE city (
	city_id INT UNSIGNED NOT NULL AUTO_INCREMENT COMMENT "Identifiant de la ville",
	city_zip_code CHAR(5) NOT NULL COMMENT "Code postal de la ville",
	city_name VARCHAR(255) NOT NULL COMMENT "Nom de la ville",
	PRIMARY KEY (city_id)
) ENGINE=InnoDB;

/* Table bakery */
CREATE TABLE bakery (
	bak_id INT UNSIGNED NOT NULL AUTO_INCREMENT COMMENT "Identifiant de la boulangerie",
	bak_type ENUM("Boulangerie", "Boulangerie-Pâtisserie", "Pâtisserie") NOT NULL DEFAULT "Boulangerie" COMMENT "Type de boulangerie",
	bak_name VARCHAR(255) NOT NULL COMMENT "Raison sociale de la boulangerie",
	bak_siret CHAR(14) NULL COMMENT "Numéro SIRET de la boulangerie",
	bak_address TEXT NOT NULL COMMENT "Adresse postale de la boulangerie",
	bak_city_id INT UNSIGNED NOT NULL COMMENT "Identifiant de la ville",
	bak_phone CHAR(10) NOT NULL COMMENT "Numéro de téléphone de la boulangerie",
	bak_email VARCHAR(255) NULL COMMENT "Adresse email de la boulangerie",
	bak_opening_hours VARCHAR(255) NULL COMMENT "Horaires d'ouverture de la boulangerie",
	bak_about TEXT NULL COMMENT "À propos de la boulangerie",
	bak_maps TEXT NOT NULL COMMENT "Carte interactive Google Maps de la boulangerie",
	bak_img VARCHAR(255) NULL COMMENT "Photographie de la boulangerie",
	bak_created_at DATETIME NOT NULL COMMENT "Date et heure de création de la boulangerie",
	bak_updated_at DATETIME NULL COMMENT "Date et heure de modification de la boulangerie",
	PRIMARY KEY (bak_id),
	INDEX (bak_city_id)
) ENGINE=InnoDB;

/* Table user */
CREATE TABLE user (
	user_id INT UNSIGNED NOT NULL AUTO_INCREMENT COMMENT "Identifiant de l'utilisateur",
	user_mail VARCHAR(320) NOT NULL UNIQUE COMMENT "Adresse mail de l'utilisateur",
	user_pwd VARCHAR(255) NOT NULL COMMENT "Mot de passe de l'utilisateur",
	user_role ENUM("user", "admin", "superadmin") NOT NULL DEFAULT "user" COMMENT "Rôle de l'utilisateur",
	user_secret VARCHAR(255) NULL COMMENT "Code secret pour le lien vers la page mot de passe oublié",
	user_expires DATETIME NULL COMMENT "Date et heure d'expiration du lien vers la page mot de passe oublié",
	user_last_login DATETIME NULL COMMENT "Date et heure de dernière connexion",
	user_created_at DATETIME NOT NULL COMMENT "Date et heure de création de l'utilisateur",
	user_updated_at DATETIME NULL COMMENT "Date et heure de modification de l'utilisateur",
	PRIMARY KEY (user_id)
) ENGINE=InnoDB;

/* Table admin */
CREATE TABLE admin (
	user_id INT UNSIGNED NOT NULL COMMENT "Identifiant de l'utilisateur",
	user_active BOOLEAN NOT NULL COMMENT "Statut du compte gérant de boulangerie",
	user_bak_id INT UNSIGNED NOT NULL COMMENT "Identifiant de la boulangerie",
	INDEX (user_id),
	INDEX (user_bak_id)
) ENGINE=InnoDB;

/* Table customer */
CREATE TABLE customer (
	user_id INT UNSIGNED NOT NULL COMMENT "Identifiant de l'utilisateur",
	user_lastname VARCHAR(255) NOT NULL COMMENT "Nom de l'utilisateur",
	user_firstname VARCHAR(255) NOT NULL COMMENT "Prénom de l'utilisateur",
	INDEX (user_id)
) ENGINE=InnoDB;

/* Table customer_bakery */
CREATE TABLE customer_bakery (
	cb_id INT UNSIGNED NOT NULL AUTO_INCREMENT COMMENT "Identifiant de la table `customer_bakery`",
	cb_like BOOLEAN DEFAULT 0 COMMENT "Mise en favori de la boulangerie",
	cb_date DATETIME NULL COMMENT "Date et heure de mise en favori",
	cb_user_id INT UNSIGNED NOT NULL COMMENT "Identifiant de l'utilisateur",
	cb_bak_id INT UNSIGNED NOT NULL COMMENT "Identifiant de la boulangerie",
	PRIMARY KEY (cb_id),
	INDEX (cb_user_id),
	INDEX (cb_bak_id)
) ENGINE=InnoDB;

/* Table served_city */
CREATE TABLE served_city (
	sc_id INT UNSIGNED NOT NULL AUTO_INCREMENT COMMENT "Indentifiant de la table `served_city`",
	sc_bak_id INT UNSIGNED NOT NULL COMMENT "Identifiant de la boulangerie",
	sc_city_id INT UNSIGNED NOT NULL COMMENT "Identifiant de la ville",
	PRIMARY KEY (sc_id),
	INDEX (sc_bak_id),
	INDEX (sc_city_id)
) ENGINE=InnoDB;

--
-- Contraintes
--

ALTER TABLE product
ADD CONSTRAINT prod_cat_idfk_1
	FOREIGN KEY (prod_cat_id)
REFERENCES category (cat_id)
	ON DELETE RESTRICT
	ON UPDATE RESTRICT;
	
ALTER TABLE product
ADD CONSTRAINT prod_bak_idfk_1
	FOREIGN KEY (prod_bak_id)
REFERENCES bakery (bak_id)
	ON DELETE RESTRICT
	ON UPDATE RESTRICT;

ALTER TABLE bakery
ADD CONSTRAINT bak_city_idfk_1
	FOREIGN KEY (bak_city_id)
REFERENCES city (city_id)
	ON DELETE RESTRICT
	ON UPDATE RESTRICT;

ALTER TABLE admin
ADD CONSTRAINT user_idfk_1
	FOREIGN KEY (user_id)
REFERENCES user (user_id)
	ON DELETE RESTRICT
	ON UPDATE RESTRICT;
	
ALTER TABLE admin
ADD CONSTRAINT user_bak_idfk_1
	FOREIGN KEY (user_bak_id)
REFERENCES bakery (bak_id)
	ON DELETE RESTRICT
	ON UPDATE RESTRICT;
	
ALTER TABLE customer
ADD CONSTRAINT user_idfk_2
	FOREIGN KEY (user_id)
REFERENCES user (user_id)
	ON DELETE RESTRICT
	ON UPDATE RESTRICT;

ALTER TABLE customer_bakery
ADD CONSTRAINT cb_user_idfk_1
	FOREIGN KEY (cb_user_id)
REFERENCES customer (user_id)
	ON DELETE RESTRICT
	ON UPDATE RESTRICT;
	
ALTER TABLE customer_bakery
ADD CONSTRAINT cb_bak_idfk_1
	FOREIGN KEY (cb_bak_id)
REFERENCES bakery (bak_id)
	ON DELETE RESTRICT
	ON UPDATE RESTRICT;

ALTER TABLE served_city
ADD CONSTRAINT sc_bak_idfk_1
	FOREIGN KEY (sc_bak_id)
REFERENCES bakery (bak_id)
	ON DELETE RESTRICT
	ON UPDATE RESTRICT;

ALTER TABLE served_city
ADD CONSTRAINT sc_city_idfk_1
	FOREIGN KEY (sc_city_id)
REFERENCES city (city_id)
	ON DELETE RESTRICT
	ON UPDATE RESTRICT;