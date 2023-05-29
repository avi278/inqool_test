DROP TABLE IF EXISTS project;
DROP TABLE IF EXISTS tag;

CREATE TABLE IF NOT EXISTS project (
    proj_id INT NOT NULL AUTO_INCREMENT,
    proj_name varchar(15) NOT NULL,
    proj_text varchar(60) NOT NULL,
    proj_date DATE DEFAULT CURDATE(),
    proj_label INT,
    PRIMARY KEY (proj_id)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS tag (
    tag_id INT NOT NULL AUTO_INCREMENT,
    tag_name varchar(15) NOT NULL,

    PRIMARY KEY (tag_id)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;