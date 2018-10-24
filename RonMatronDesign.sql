--This table will consist of keywords from questions asked that will be linked to relevant answers
--keyword_id is a unique 6 digit code that identifies each keyword.

drop table keyword cascade constraints;

create table keyword
(keyword_id   char(6),
 keyword_cat   varchar(20),
 keyword   varchar(20) not null,
 primary key (keyword_id)
);
 
 /* This table will consist of a repositiory of correct answers to common questions that will 
    be linked to questions through the keywords table. answer_id is a unique 4 digit code that 
    identifies each keyword.
  */
  
  drop table answer cascade constraints;
  
  create table answer
  (answer_id   char(4),
   answer_cat   varchar(20) not null,
   answer   varchar(20) not null,
   primary key (answer_id)
  );
   
   /* This table will consist of categories of types of questions and answers (ie. answers
      relating to printers would belong to a "printer" category, or questions asked about
      where to find certain software sets would be linked to a "software category")
   */
   
   drop table category cascade constraints;
   
   create table category 
   (category_id   char(4),
    category_name   varchar(20) not null,
    keyword_id   char(6), 
    answer_id   char(4),
    primary key (category_id),
    foreign key (keyword_id) references keyword,
    foreign key (answer_id) references answer
   );
    
    /* This table will describe what answers may be relevant to specific keywords grabbed
       from questions.
    */
    
    drop table keyword_has_answer cascade constraints;
    
    create table keyword_has_answer
    (keyword_id   char(6),
     answer_id   char(4),
     primary key (keyword_id, answer_id),
     foreign key (keyword_id) references keyword,
     foreign key (answer_id) references answer
    );
       
    /* This table will consist of a repository of feedback responses that the admins
       can use to 
