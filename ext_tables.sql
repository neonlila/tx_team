CREATE TABLE tx_team_domain_model_department (
    title varchar(255) DEFAULT '' NOT NULL
);

CREATE TABLE tx_team_domain_model_member (
    department int(11) unsigned DEFAULT '0' NOT NULL,
    name varchar(255) DEFAULT '' NOT NULL,
    phone varchar(255) DEFAULT '' NOT NULL,
    email varchar(255) DEFAULT '' NOT NULL,
    position varchar(255) DEFAULT '' NOT NULL,
    bio text,
    linkedin varchar(255) DEFAULT '' NOT NULL,
    photo int(11) unsigned DEFAULT '0' NOT NULL
);