-- public.quizzes definition

-- Drop table

-- DROP TABLE public.quizzes;

CREATE TABLE public.quizzes (
	id int4 NOT NULL DEFAULT nextval('quizz_id'::regclass),
	title varchar(255) NOT NULL,
	category varchar(255) NULL,
	is_public bool NULL DEFAULT true,
	solved int4 NULL,
	created_at timestamp NULL,
	thumbnail varchar(255) NULL,
	CONSTRAINT quizzes_pkey PRIMARY KEY (id)
);


-- public.users definition

-- Drop table

-- DROP TABLE public.users;

CREATE TABLE public.users (
	id int8 NOT NULL DEFAULT nextval('users_id_autoincrement'::regclass),
	"name" varchar(255) NOT NULL,
	"password" varchar(255) NULL,
	email varchar(255) NOT NULL,
	display_name varchar(255) NOT NULL,
	CONSTRAINT user_pkey PRIMARY KEY (id)
);


-- public.questions definition

-- Drop table

-- DROP TABLE public.questions;

CREATE TABLE public.questions (
	id int4 NOT NULL DEFAULT nextval('question_id'::regclass),
	quiz_id int4 NOT NULL,
	question varchar(255) NOT NULL,
	image_url varchar(255) NULL,
	answers json NOT NULL,
	correct_answer int4 NOT NULL,
	points int2 NOT NULL DEFAULT 1,
	CONSTRAINT questions_pkey PRIMARY KEY (id),
	CONSTRAINT fk FOREIGN KEY (quiz_id) REFERENCES public.quizzes(id)
);


-- public.quizzes_owners definition

-- Drop table

-- DROP TABLE public.quizzes_owners;

CREATE TABLE public.quizzes_owners (
	id int4 NOT NULL DEFAULT nextval('ownership_id'::regclass),
	user_id int4 NOT NULL,
	quiz_id int4 NOT NULL,
	is_creator bool NULL DEFAULT true,
	CONSTRAINT quizzes_owners_pkey PRIMARY KEY (id),
	CONSTRAINT fk FOREIGN KEY (user_id) REFERENCES public.users(id)
);