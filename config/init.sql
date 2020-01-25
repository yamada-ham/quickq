create database QuestQ character set utf8;

use QuestQ

create table users_php (
  id int not null auto_increment primary key,
  email varchar(255) unique,
  password varchar(255),
  userName varchar(255),
  created datetime,
  modified datetime
);

desc users;


create table quests (
  id int not null auto_increment primary key,
  code varchar(100) unique,
  questTitle varchar(255),
  choicesNum INT DEFAULT 2,
  choicesList varchar(255),
  category varchar(100),
  userId varchar(100),
  numberOfResponses INT DEFAULT 0,
  created datetime,
  modified datetime
);

create table answers (
  id int not null auto_increment primary key,
  code varchar(255) ,
  age varchar(255),
  sex varchar(255),
  questTitle varchar(255),
  choice varchar(255),
  remote_addr varchar(30),
  user_agent varchar(255),
  unique unique_answer(remote_addr,user_agent,code),
  created datetime
);


insert into quests(code,questTitle,choicesNum,choicesList,category,userId,created,modified) values("xc",'やさい3',2,"賛成,反対",'料理','99',now(),now());
insert into quests(code,questTitle,choicesNum,choicesList,category,userId,created,modified) values("yc",'やさい3',2,"賛成,反対",'料理','99',now(),now());
insert into quests(code,questTitle,choicesNum,choicesList,category,userId,created,modified) values("ca",'やさい3',2,"賛成,反対",'料理','99',now(),now());
insert into quests(code,questTitle,choicesNum,choicesList,category,userId,created,modified) values("uc",'やさい3',2,"賛成,反対",'料理','99',now(),now());
insert into quests(code,questTitle,choicesNum,choicesList,category,userId,created,modified) values("vc",'やさい3',2,"賛成,反対",'料理','99',now(),now());
insert into quests(code,questTitle,choicesNum,choicesList,category,userId,created,modified) values("wc",'やさい3',2,"賛成,反対",'料理','99',now(),now());
