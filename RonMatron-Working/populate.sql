delete from category2;

delete from keyword2;

delete from answer2;

delete from keyword_has_answer2;

delete from feedback2;

delete from feedback_keywords2;


prompt inserting into table category2

insert into category2
values
('0000', 'General');

insert into category2
values
('0001', 'what');

insert into category2
values
('0002', 'where');

insert into category2
values
('0003', 'when');

insert into category2
values
('0004', 'why');

insert into category2
values
('0005', 'how');

insert into category2
values
('0006', 'Printing');

insert into category2
values
('0007', 'who');

prompt inserting rows into table keyword2

insert into keyword2
values
('000000', '0002', '7-Zip');

insert into keyword2
values
('000001', '0002', 'Mathematica');

insert into keyword2
values
('000002', '0002', 'CodeBlocks');

insert into keyword2
values
('000003', '0002', 'Python');

insert into keyword2
values
('000004', '0002', 'CodonCode Aligner');

insert into keyword2
values
('000005', '0005', 'Printer');

insert into keyword2
values
('000006', '0002', 'Print');

insert into keyword2
values
('000007', '0002', 'Kiosks');

insert into keyword2
values
('000008', '0002', 'Located');

insert into keyword2
values
('000009', '0005', 'add');

insert into keyword2
values
('000010', '0005', 'money');

insert into keyword2
values
('000011', '0005', 'c-card');




prompt inserting rows into answer2
prompt This is the insert for 7-Zip
insert into answer2
values
('0000', '0002', 'All Locations, VLab - GSP-FOR-GEOL-WDFS');

prompt This insert is for mathematica 
insert into answer2
values
('0001', '0002', 'All Locations');

prompt This insert is for CodeBlocks
insert into answer2
values
('0002', '0002', 'BSS 302, BSS 308, BSS 313, BSS 316A, JH 214, SCID 13, SCID 15, SCID 17, SCID 23, SCID 3, SCID 5, vLinux');

prompt This insert is for python
insert into answer2
values
('0003', '0002', 'All Locations');

prompt This insert if for CodonCode Aligner
insert into answer2
values
('0004', '0002', 'SCIA 364, SCIA 460, SCIB 121, SCIB 121a, SCIB 122, SCIB 132, SCIB 135, SCIB 328');

prompt This insert is how to print on campus question
insert into answer2
values
('0005', '0006', 'its.humboldt.edu/computers-printers-phones/windows-wireless-printing-installation-students');

prompt This insert is for where print kiosks are located
insert into answer2
values
('0006','0002','Natural Resources, Forestry, Harry Griffith Hall, Gist Hall, The University Center, Founders Hall, Kineseology, and Library');

insert into answer2
values
('0007','0005','Funds may be added online at c-card.humboldt.edu, at any cashier on campus for example: the Marketplace, Depot, or Library Cafe, or on the second floor of the library near the stairwell.');


prompt insert into table keyword_has_answer

insert into keyword_has_answer2 
values
('000000','0000');

insert into keyword_has_answer2 
values
('000001','0001');

insert into keyword_has_answer2 
values
('000002','0002');

insert into keyword_has_answer2 
values
('000003','0003');

insert into keyword_has_answer2 
values
('000004','0004');

insert into keyword_has_answer2 
values
('000005','0005');

insert into keyword_has_answer2 
values
('000006','0006');

insert into keyword_has_answer2 
values
('000007','0006');

insert into keyword_has_answer2 
values
('000008','0006');

insert into keyword_has_answer2 
values
('000009','0007');

insert into keyword_has_answer2 
values
('000010','0007');

insert into keyword_has_answer2 
values
('000011','0007');


prompt inserting into the feedback table 

insert into feedback2
values
('0000','RonMatron was greatly helpful with helping me locate where python is located so I can finish my python homework.','0000', '0003',1, 'Kurt J. Miner','KurtMiner@gmail.com');

insert into feedback2
values
('0001','RonMatron helped me figure out how to print to one of the wireless printers on campus.','0006', '0005', 1, 'Virgil N. Bauder','Bauder@hotmail.com');

prompt inserting into the feedback_keywords table

insert into feedback_keywords2
values
('000003', '0000');

insert into feedback_keywords2
values
('000005', '0001');
