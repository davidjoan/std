CREATE TABLE t_action (id BIGINT AUTO_INCREMENT, name VARCHAR(100) NOT NULL, description VARCHAR(255) NOT NULL, route VARCHAR(200) NOT NULL, param VARCHAR(200), slug VARCHAR(255), created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, UNIQUE INDEX u_param_idx (param), INDEX i_created_at_idx (created_at), INDEX i_updated_at_idx (updated_at), UNIQUE INDEX t_action_sluggable_idx (slug), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_bin ENGINE = INNODB;
CREATE TABLE t_action_profile (action_id BIGINT, profile_id BIGINT, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX i_created_at_idx (created_at), INDEX i_updated_at_idx (updated_at), PRIMARY KEY(action_id, profile_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_bin ENGINE = INNODB;
CREATE TABLE t_area (id BIGINT AUTO_INCREMENT, representative_id BIGINT NOT NULL, rank BIGINT, name VARCHAR(50) NOT NULL, description TEXT, active CHAR(1) DEFAULT '0' NOT NULL, slug VARCHAR(255), created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, root_id BIGINT, lft INT, rgt INT, level SMALLINT, INDEX i_active_idx (active), UNIQUE INDEX t_area_sluggable_idx (slug), INDEX representative_id_idx (representative_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_bin ENGINE = INNODB;
CREATE TABLE t_document (id BIGINT AUTO_INCREMENT, record_id BIGINT NOT NULL, user_id BIGINT NOT NULL, area_id BIGINT NOT NULL, representative_id BIGINT, document_class_id BIGINT, code VARCHAR(50) NOT NULL, issue VARCHAR(200), qty BIGINT DEFAULT 0, type CHAR(1) DEFAULT '0', description TEXT, observations TEXT, main TEXT, reception_method CHAR(1) DEFAULT 'R' NOT NULL, document_date DATETIME, reception_date DATETIME, registration_type CHAR(1) DEFAULT '0' NOT NULL, path VARCHAR(255) NOT NULL, active CHAR(1) DEFAULT '1' NOT NULL, slug VARCHAR(255), created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX i_code_idx (code), UNIQUE INDEX u_code_idx (code), INDEX i_active_idx (active), UNIQUE INDEX t_document_sluggable_idx (slug), INDEX record_id_idx (record_id), INDEX user_id_idx (user_id), INDEX area_id_idx (area_id), INDEX document_class_id_idx (document_class_id), INDEX representative_id_idx (representative_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_bin ENGINE = INNODB;
CREATE TABLE t_document_class (id BIGINT AUTO_INCREMENT, name VARCHAR(200) NOT NULL, description TEXT NOT NULL, active CHAR(1) DEFAULT '1' NOT NULL, slug VARCHAR(255), created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX i_name_idx (name), INDEX i_active_idx (active), UNIQUE INDEX t_document_class_sluggable_idx (slug), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_bin ENGINE = INNODB;
CREATE TABLE t_profile (id BIGINT AUTO_INCREMENT, name VARCHAR(100) NOT NULL, description TEXT, slug VARCHAR(255), created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, UNIQUE INDEX u_name_idx (name), INDEX i_created_at_idx (created_at), INDEX i_updated_at_idx (updated_at), UNIQUE INDEX t_profile_sluggable_idx (slug), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_bin ENGINE = INNODB;
CREATE TABLE t_record (id BIGINT AUTO_INCREMENT, from_area_id BIGINT, to_area_id BIGINT, user_id BIGINT NOT NULL, code VARCHAR(20) NOT NULL, subject VARCHAR(250) NOT NULL, time_limit BIGINT, description TEXT, status CHAR(1) DEFAULT '1' NOT NULL, active CHAR(1) DEFAULT '1' NOT NULL, slug VARCHAR(255), created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX i_active_idx (active), UNIQUE INDEX t_record_sluggable_idx (slug), INDEX user_id_idx (user_id), INDEX from_area_id_idx (from_area_id), INDEX to_area_id_idx (to_area_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_bin ENGINE = INNODB;
CREATE TABLE t_record_log (id BIGINT AUTO_INCREMENT, record_id BIGINT NOT NULL, user_id BIGINT NOT NULL, from_area_id BIGINT NOT NULL, to_area_id BIGINT NOT NULL, code VARCHAR(20) NOT NULL, subject VARCHAR(250) NOT NULL, time_limit BIGINT, description TEXT NOT NULL, status CHAR(1) DEFAULT '1' NOT NULL, active CHAR(1) DEFAULT '1' NOT NULL, slug VARCHAR(255), created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX i_active_idx (active), UNIQUE INDEX t_record_log_sluggable_idx (slug), INDEX record_id_idx (record_id), INDEX user_id_idx (user_id), INDEX from_area_id_idx (from_area_id), INDEX to_area_id_idx (to_area_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_bin ENGINE = INNODB;
CREATE TABLE t_representative (id BIGINT AUTO_INCREMENT, dni VARCHAR(20) NOT NULL, firstname VARCHAR(200) NOT NULL, lastname VARCHAR(200) NOT NULL, description TEXT, active CHAR(1) DEFAULT '1' NOT NULL, slug VARCHAR(255), created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX i_firstname_idx (firstname), INDEX i_active_idx (active), UNIQUE INDEX t_representative_sluggable_idx (slug), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_bin ENGINE = INNODB;
CREATE TABLE t_user (id BIGINT AUTO_INCREMENT, area_id BIGINT NOT NULL, profile_id BIGINT NOT NULL, username VARCHAR(100) NOT NULL, password VARCHAR(255) NOT NULL, first_name VARCHAR(100) NOT NULL, last_name VARCHAR(100) NOT NULL, email VARCHAR(100) NOT NULL, phone VARCHAR(50), active CHAR(1) DEFAULT '1' NOT NULL, last_access_at DATETIME, slug VARCHAR(255), created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, UNIQUE INDEX u_username_idx (username), UNIQUE INDEX u_firstname_lastname_idx (first_name, last_name), INDEX i_active_idx (active), INDEX i_created_at_idx (created_at), INDEX i_updated_at_idx (updated_at), UNIQUE INDEX t_user_sluggable_idx (slug), INDEX profile_id_idx (profile_id), INDEX area_id_idx (area_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_bin ENGINE = INNODB;
CREATE TABLE t_visit (id BIGINT AUTO_INCREMENT, remote_address VARCHAR(50) NOT NULL, remote_port VARCHAR(50) NOT NULL, http_user_agent VARCHAR(255) NOT NULL, datetime datetime NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX i_remote_address_idx (remote_address), INDEX i_datetime_idx (datetime), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_bin ENGINE = INNODB;
ALTER TABLE t_action_profile ADD CONSTRAINT t_action_profile_profile_id_t_profile_id FOREIGN KEY (profile_id) REFERENCES t_profile(id) ON UPDATE CASCADE ON DELETE CASCADE;
ALTER TABLE t_action_profile ADD CONSTRAINT t_action_profile_action_id_t_action_id FOREIGN KEY (action_id) REFERENCES t_action(id) ON UPDATE CASCADE ON DELETE CASCADE;
ALTER TABLE t_area ADD CONSTRAINT t_area_representative_id_t_representative_id FOREIGN KEY (representative_id) REFERENCES t_representative(id) ON UPDATE CASCADE ON DELETE CASCADE;
ALTER TABLE t_document ADD CONSTRAINT t_document_user_id_t_user_id FOREIGN KEY (user_id) REFERENCES t_user(id) ON UPDATE CASCADE ON DELETE CASCADE;
ALTER TABLE t_document ADD CONSTRAINT t_document_representative_id_t_representative_id FOREIGN KEY (representative_id) REFERENCES t_representative(id) ON UPDATE CASCADE ON DELETE CASCADE;
ALTER TABLE t_document ADD CONSTRAINT t_document_record_id_t_record_id FOREIGN KEY (record_id) REFERENCES t_record(id) ON UPDATE CASCADE ON DELETE CASCADE;
ALTER TABLE t_document ADD CONSTRAINT t_document_document_class_id_t_document_class_id FOREIGN KEY (document_class_id) REFERENCES t_document_class(id) ON UPDATE CASCADE ON DELETE CASCADE;
ALTER TABLE t_document ADD CONSTRAINT t_document_area_id_t_area_id FOREIGN KEY (area_id) REFERENCES t_area(id) ON UPDATE CASCADE ON DELETE CASCADE;
ALTER TABLE t_record ADD CONSTRAINT t_record_user_id_t_user_id FOREIGN KEY (user_id) REFERENCES t_user(id) ON UPDATE CASCADE ON DELETE CASCADE;
ALTER TABLE t_record ADD CONSTRAINT t_record_to_area_id_t_area_id FOREIGN KEY (to_area_id) REFERENCES t_area(id) ON UPDATE CASCADE ON DELETE CASCADE;
ALTER TABLE t_record ADD CONSTRAINT t_record_from_area_id_t_area_id FOREIGN KEY (from_area_id) REFERENCES t_area(id) ON UPDATE CASCADE ON DELETE CASCADE;
ALTER TABLE t_record_log ADD CONSTRAINT t_record_log_user_id_t_user_id FOREIGN KEY (user_id) REFERENCES t_user(id) ON UPDATE CASCADE ON DELETE CASCADE;
ALTER TABLE t_record_log ADD CONSTRAINT t_record_log_to_area_id_t_area_id FOREIGN KEY (to_area_id) REFERENCES t_area(id) ON UPDATE CASCADE ON DELETE CASCADE;
ALTER TABLE t_record_log ADD CONSTRAINT t_record_log_record_id_t_record_id FOREIGN KEY (record_id) REFERENCES t_record(id) ON UPDATE CASCADE ON DELETE CASCADE;
ALTER TABLE t_record_log ADD CONSTRAINT t_record_log_from_area_id_t_area_id FOREIGN KEY (from_area_id) REFERENCES t_area(id) ON UPDATE CASCADE ON DELETE CASCADE;
ALTER TABLE t_user ADD CONSTRAINT t_user_profile_id_t_profile_id FOREIGN KEY (profile_id) REFERENCES t_profile(id) ON UPDATE CASCADE ON DELETE CASCADE;
ALTER TABLE t_user ADD CONSTRAINT t_user_area_id_t_area_id FOREIGN KEY (area_id) REFERENCES t_area(id) ON UPDATE CASCADE ON DELETE CASCADE;
