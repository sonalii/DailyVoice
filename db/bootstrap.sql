-- DROP SCHEMA `daily_voice` ;
-- DROP USER 'DV_USER'@'localhost';


CREATE SCHEMA `daily_voice` ;

GRANT ALL PRIVILEGES ON daily_voice.* To 'DV_USER'@'localhost' IDENTIFIED BY 'password';


USE `daily_voice`;

CREATE TABLE `dv_images` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `TITLE` varchar(500) NOT NULL,
  `URL` varchar(500) NOT NULL,
  `LIKES` int(11) DEFAULT '0',
  `DISLIKES` int(11) DEFAULT '0',
  `LAST_MODIFY_DT` datetime DEFAULT NULL,
  PRIMARY KEY (`ID`)
);



CREATE TABLE `dv_votes` (
  `user_ip` varchar(45) NOT NULL,
  `image_id` int(11) NOT NULL,
  `up_or_down` bit(1) DEFAULT NULL,
  `vote_date` datetime DEFAULT NULL,
  UNIQUE KEY `uidx_dv_votes` (`user_ip`,`image_id`),
  KEY `fk_dv_votes_image_id_idx` (`image_id`),
  CONSTRAINT `fk_dv_votes_image_id` FOREIGN KEY (`image_id`) REFERENCES `dv_images` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION
);


-- delete from `daily_voice`.`dv_votes`;
-- delete from `daily_voice`.`dv_images`;


INSERT INTO `daily_voice`.`dv_images`
(`ID`,`TITLE`, `URL`, `LIKES`, `DISLIKES`, `LAST_MODIFY_DT`)
VALUES
(1, "Don't you love this photo 1", "/public/img/cats/cat1.jpg", 1, 0, now()),
(2, "Don't you love this photo 2", "/public/img/cats/cat2.jpg", 0, 0, now()), 
(3, "Don't you love this photo 3", "/public/img/cats/cat3.jpg", 0, 0, now()), 
(4, "Don't you love this photo 4", "/public/img/cats/cat4.jpg", 0, 0, now()),
(5, "Don't you love this photo 5", "/public/img/cats/cat5.jpg", 0, 0, now()),
(6, "Don't you love this photo 6", "/public/img/cats/cat6.jpg", 0, 0, now()),
(7, "Don't you love this photo 7", "/public/img/cats/cat7.jpg", 0, 0, now());


INSERT INTO `dv_votes` VALUES ('::1',1,'\0','2014-03-13 22:57:04');

commit;