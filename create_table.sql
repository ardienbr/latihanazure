create table [dbo].[Kontak](
    id INT NOT NULL IDENTITY(1,1) PRIMARY KEY(id),
    nama VARCHAR(30),
    email VARCHAR(30),
    komentar VARCHAR(150),
    date DATE
);
