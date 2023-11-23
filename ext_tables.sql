CREATE TABLE tt_content (
    quotes int(11) DEFAULT '0' NOT NULL,
    quotes_records int(11) DEFAULT '0' NOT NULL,
);

CREATE TABLE tx_hhextquotes_domain_model_quote (
    uid int(11) unsigned DEFAULT '0' NOT NULL auto_increment,
    pid int(11) DEFAULT '0' NOT NULL,

    title varchar(255) DEFAULT '' NOT NULL,
    description text NOT NULL,

    author int(11) DEFAULT '0' NOT NULL,
    author_info varchar(255) DEFAULT '' NOT NULL,

    PRIMARY KEY (uid),
    KEY parent (pid)
);
