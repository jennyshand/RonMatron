delete from category;

delete from keyword;

delete from answer;

delete from keyword_has_answer;

delete from feedback;

delete from feedback_keywords;


prompt inserting into table category

insert into category
values
('0000', 'Software');

insert into category
values
('0001', 'what');

insert into category
values
('0002', 'where');

insert into category
values
('0003', 'when');

insert into category
values
('0004', 'why');

insert into category
values
('0005', 'how');

insert into category
values
('0006', 'Printing');

prompt inserting rows into table keyword

insert into keyword
values
('000000', '0000', '7-Zip');

insert into keyword
values
('000001', '0000', 'Mathematica');

insert into keyword
values
('000002', '0000', 'CodeBlocks');

insert into keyword
values
('000003', '0000', 'Python');

insert into keyword
values
('000004', '0000', 'CodonCode Aligner');

insert into keyword
values
('000005', '0005', 'Printer');


prompt inserting rows into answer
prompt This is the insert for 7-Zip
insert into answer
values
('0000', '0000', 'All Locations, VLab - GSP-FOR-GEOL-WDFS','0002');

prompt This insert is for mathematica 
insert into answer
values
('0001', '0000', 'All Locations','0002');

prompt This insert is for CodeBlocks
insert into answer
values
('0002', '0000', 'BSS 302, BSS 308, BSS 313, BSS 316A, JH 214, SCID 13, SCID 15, SCID 17, SCID 23, SCID 3, SCID 5, vLinux','0002');

prompt This insert is for python
insert into answer
values
('0003', '0000', 'All Locations','0002');

prompt This insert if for CodonCode Aligner
insert into answer
values
('0004', '0000', 'SCIA 364, SCIA 460, SCIB 121, SCIB 121a, SCIB 122, SCIB 132, SCIB 135, SCIB 328','0002');

prompt This insert is how to print on campus question
insert into answer
values
('0005', '0006', 'its.humboldt.edu/computers-printers-phones/windows-wireless-printing-installation-students', '0005');


prompt insert into table keyword_has_answer

insert into keyword_has_answer 
values
('000000','0000');

insert into keyword_has_answer 
values
('000001','0001');

insert into keyword_has_answer 
values
('000002','0002');

insert into keyword_has_answer 
values
('000003','0003');

insert into keyword_has_answer 
values
('000004','0004');

insert into keyword_has_answer 
values
('000005','0005');


prompt inserting into the feedback table 

insert into feedback
values
('0000','RonMatron was greatly helpful with helping me locate where python is located so I can finish my python homework.','0000', '0003');

insert into feedback
values
('0001','RonMatron helped me figure out how to print to one of the wireless printers on campus.','0006', '0005');

prompt inserting into the feedback_keywords table

insert into feedback_keywords
values
('000003', '0000');

insert into feedback_keywords
values
('000005', '0001');
