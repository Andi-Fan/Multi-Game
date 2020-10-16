drop table appuser cascade;

create table appuser (
	userid varchar(50) primary key,
	password varchar(50),
	gender varchar(50),
	color varchar(50),
	student varchar(20),
	fulltime varchar(20),
	parttime varchar(20),
	unemployed varchar(20),
	email varchar (50),
	phone varchar(50)
);

create table gamestats (
	userid varchar(50) references appuser(userid),
	PRIMARY KEY(userid),
	guessGame text[],
	puzzle text[],
	pegsolitaire text[],
	mastermind text[]
);

insert into appuser values('auser', 'apassword');


