/* This table will consist of categories of types of questions and answers (ie. answers
      relating to printers would belong to a "printer" category, or questions asked about
      where to find certain software sets would be linked to a "software category")
 */
   
 drop table category2 cascade constraints;
   
 create table category2 
 (category_id   char(4),
  category_name  varchar2(20),
  primary key (category_id)
 );

--This table will consist of keywords from questions asked that will be linked to relevant answers
--keyword_id is a unique 6 digit code that identifies each keyword.

 drop table keyword2 cascade constraints;

 create table keyword2
 (keyword_id   int,
  category_id  char(4) not null,
  keyword_name   varchar2(100) not null,
  primary key (keyword_id),
  foreign key (category_id) references category2
 );
 
 /* This table will consist of a repository of correct answers to common questions that will 
    be linked to questions through the keywords table. answer_id is a unique 4 digit code that 
    identifies each keyword.
 */
  
 drop table answer2 cascade constraints;
  
 create table answer2
 (answer_id  int,
  category_id  char(4) not null,
  answer_name  varchar2(200),
  primary key (answer_id),
  foreign key (category_id) references category2
 );
   
    
 /* This table will describe what answers may be relevant to specific keywords grabbed
    from questions.
 */
   
 drop table keyword_has_answer2 cascade constraints;
    
 create table keyword_has_answer2
 (keyword_id   int,
  answer_id   int,
  primary key (keyword_id, answer_id),
  foreign key (keyword_id) references keyword2,
  foreign key (answer_id) references answer2
 );
       
 /* This table will consist of a repository of feedback responses that the admins
    can use to update relevant answers linked to keywords from questions */
      
 drop table feedback2 cascade constraints;
    
 create table feedback2 
 (feedback_id   char(4),
  feedback_info   varchar2(500) not null,
  rating          int,
  name            varchar2(50),
  email           varchar2(50),
  category_id  char(4) not null,
  answer_id   int,
  primary key (feedback_id),
  foreign key (category_id) references category2,
  foreign key (answer_id) references answer2
 );
     
 /* This table links feedback to various keywords from questions asked by users for
    admins to evaluate and implement, if necessary */
     
 drop table feedback_keywords2 cascade constraints;
     
 create table feedback_keywords2
 (keyword_id   int, 
  feedback_id   char(4),
  primary key (keyword_id, feedback_id),
  foreign key (keyword_id) references keyword2,
  foreign key (feedback_id) references feedback2
);
