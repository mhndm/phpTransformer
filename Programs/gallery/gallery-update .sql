first rename folder uploads to lower case
move folder 
and excute :

UPDATE `gallery` SET `Path` = REPLACE(Path, 'Programs/gallery/', 'uploads/gallery/');
UPDATE `pagelang` SET `Content` = REPLACE(Content, 'Programs/gallery/', 'uploads/gallery/');
UPDATE `newslang` SET `Breif` = REPLACE(Breif, 'Programs/gallery/', 'uploads/gallery/');
UPDATE `newslang` SET `FullMessage` = REPLACE(FullMessage, 'Programs/gallery/', 'uploads/gallery/');
