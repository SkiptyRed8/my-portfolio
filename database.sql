-- ============================================================
--  Portfolio database
--  Name: Bonaobra Amalyn T. | Section: BSIT 2 Y2-2
--
--  Run this once in phpMyAdmin (Import tab) or the MySQL CLI.
--  NOTE: on free hosts (InfinityFree, etc.) you usually can't run
--  CREATE DATABASE. Create the database from the hosting control
--  panel instead, select it in phpMyAdmin, and run only the
--  CREATE TABLE statement below.
-- ============================================================

CREATE DATABASE IF NOT EXISTS portfolio_db
  CHARACTER SET utf8mb4
  COLLATE utf8mb4_unicode_ci;

USE portfolio_db;

-- The only table the project needs.
CREATE TABLE IF NOT EXISTS contact_messages (
    id         INT          NOT NULL AUTO_INCREMENT,
    name       VARCHAR(100) NOT NULL,
    email      VARCHAR(100) NOT NULL,
    message    TEXT         NOT NULL,
    date_sent  TIMESTAMP    NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
