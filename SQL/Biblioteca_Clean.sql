-- MySQL Script generated by MySQL Workbench
-- Wed Dec 13 10:57:50 2023
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema Biblioteca
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema Biblioteca
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `Biblioteca` DEFAULT CHARACTER SET utf8 ;
USE `Biblioteca` ;

-- -----------------------------------------------------
-- Table `Biblioteca`.`turma`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Biblioteca`.`turma` (
  `IdTurma` INT NOT NULL AUTO_INCREMENT,
  `AnoTurma` VARCHAR(50) NOT NULL,
  `NomeTurma` VARCHAR(50) NULL DEFAULT NULL,
  `AnodeInicio` INT NULL DEFAULT NULL,
  PRIMARY KEY (`IdTurma`))
ENGINE = InnoDB
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8mb3;


-- -----------------------------------------------------
-- Table `Biblioteca`.`aluno`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Biblioteca`.`aluno` (
  `idAluno` INT NOT NULL AUTO_INCREMENT,
  `NomeAluno` VARCHAR(100) NOT NULL,
  `EmailAluno` VARCHAR(100) NULL DEFAULT NULL,
  `ObsAluno` VARCHAR(250) NULL DEFAULT NULL,
  `Turma_idTurma` INT NOT NULL,
  PRIMARY KEY (`idAluno`),
  INDEX `fk_Aluno_Turma1_idx` (`Turma_idTurma` ASC) VISIBLE,
  CONSTRAINT `fk_Aluno_Turma1`
    FOREIGN KEY (`Turma_idTurma`)
    REFERENCES `Biblioteca`.`turma` (`IdTurma`))
ENGINE = InnoDB
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8mb3;


-- -----------------------------------------------------
-- Table `Biblioteca`.`autor`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Biblioteca`.`autor` (
  `idAutor` INT NOT NULL AUTO_INCREMENT,
  `NomeAutor` VARCHAR(100) NOT NULL,
  PRIMARY KEY (`idAutor`))
ENGINE = InnoDB
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8mb3;


-- -----------------------------------------------------
-- Table `Biblioteca`.`genero`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Biblioteca`.`genero` (
  `idGenero` INT NOT NULL AUTO_INCREMENT,
  `NomeGenero` VARCHAR(50) NOT NULL,
  PRIMARY KEY (`idGenero`))
ENGINE = InnoDB
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8mb3;


-- -----------------------------------------------------
-- Table `Biblioteca`.`idioma`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Biblioteca`.`idioma` (
  `idIdioma` INT NOT NULL AUTO_INCREMENT,
  `Idioma` VARCHAR(50) NOT NULL,
  PRIMARY KEY (`idIdioma`))
ENGINE = InnoDB
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8mb3;


-- -----------------------------------------------------
-- Table `Biblioteca`.`livro`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Biblioteca`.`livro` (
  `idLivro` INT NOT NULL AUTO_INCREMENT,
  `NomeLivro` VARCHAR(100) NOT NULL,
  `IBSMLivro` VARCHAR(50) NULL DEFAULT NULL,
  `LocalLivro` VARCHAR(250) NULL DEFAULT NULL,
  `PrateleiraLivro` VARCHAR(100) NULL DEFAULT NULL,
  `ColunaLivro` VARCHAR(100) NULL DEFAULT NULL,
  `autor_idAutor` INT NOT NULL,
  `Genero_idGenero` INT NOT NULL,
  `Idioma_idIdioma` INT NOT NULL,
  `FotoLivro` BLOB NULL DEFAULT NULL,
  `EditoraLivro` VARCHAR(100) CHARACTER SET 'utf8mb3' NULL DEFAULT NULL,
  `EdicaoLivro` VARCHAR(100) NULL DEFAULT NULL,
  `CaminhoFotoLivro` VARCHAR(255) NULL DEFAULT NULL,
  `Quantidadelivros` INT NOT NULL,
  `DidaticoLivro` VARCHAR(10) NULL DEFAULT NULL,
  PRIMARY KEY (`idLivro`),
  INDEX `fk_Livro_Altor_idx` (`autor_idAutor` ASC) VISIBLE,
  INDEX `fk_Livro_Genero1_idx` (`Genero_idGenero` ASC) VISIBLE,
  INDEX `fk_Livro_Idioma1_idx` (`Idioma_idIdioma` ASC) VISIBLE,
  CONSTRAINT `fk_Livro_Genero1`
    FOREIGN KEY (`Genero_idGenero`)
    REFERENCES `Biblioteca`.`genero` (`idGenero`),
  CONSTRAINT `fk_Livro_Idioma1`
    FOREIGN KEY (`Idioma_idIdioma`)
    REFERENCES `Biblioteca`.`idioma` (`idIdioma`),
  CONSTRAINT `fk_Livro_Altor`
    FOREIGN KEY (`autor_idAutor`)
    REFERENCES `Biblioteca`.`autor` (`idAutor`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION
)
ENGINE = InnoDB
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8mb3;

-- -----------------------------------------------------
-- Table `Biblioteca`.`prof`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Biblioteca`.`prof` (
  `idProf` INT NOT NULL AUTO_INCREMENT,
  `NomeProf` VARCHAR(100) NOT NULL,
  `EmailProf` VARCHAR(100) NOT NULL,
  `MateriaProf` VARCHAR(50) NULL DEFAULT NULL,
  `ObsProf` VARCHAR(250) NULL DEFAULT NULL,
  PRIMARY KEY (`idProf`))
ENGINE = InnoDB
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8mb3;


-- -----------------------------------------------------
-- Table `Biblioteca`.`usuario`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Biblioteca`.`usuario` (
  `idUsuario` INT NOT NULL AUTO_INCREMENT,
  `UserUsuario` VARCHAR(100) NOT NULL,
  `NomeUsuario` VARCHAR(100) NOT NULL,
  `EmailUsuario` VARCHAR(100) NOT NULL,
  `SenhaUsuario` VARCHAR(100) NOT NULL,
  `FotoUsuario` BLOB NULL DEFAULT NULL,
  `CamFoto` VARCHAR(200) NOT NULL,
  PRIMARY KEY (`idUsuario`))
ENGINE = InnoDB
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8mb3;


-- -----------------------------------------------------
-- Table `Biblioteca`.`emprestimo`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Biblioteca`.`emprestimo` (
  `idEmprestimo` INT NOT NULL AUTO_INCREMENT,
  `DataEmprestimo` DATE NOT NULL,
  `StatusEmprestimo` INT NOT NULL,
  `livro_idLivro` INT NOT NULL,
  `usuario_idUsuario` INT NOT NULL,
  `prof_idProf` INT NULL DEFAULT NULL,
  `aluno_idAluno` INT NULL DEFAULT NULL,
  `Quantidade_emp` INT NOT NULL,
  PRIMARY KEY (`idEmprestimo`),
  INDEX `fk_empestimo_livro1_idx` (`livro_idLivro` ASC) VISIBLE,
  INDEX `fk_empestimo_usuario1_idx` (`usuario_idUsuario` ASC) VISIBLE,
  INDEX `fk_empestimo_prof1_idx` (`prof_idProf` ASC) VISIBLE,
  INDEX `fk_empestimo_aluno1_idx` (`aluno_idAluno` ASC) VISIBLE,
  CONSTRAINT `fk_empestimo_aluno1`
    FOREIGN KEY (`aluno_idAluno`)
    REFERENCES `Biblioteca`.`aluno` (`idAluno`),
  CONSTRAINT `fk_empestimo_livro1`
    FOREIGN KEY (`livro_idLivro`)
    REFERENCES `Biblioteca`.`livro` (`idLivro`),
  CONSTRAINT `fk_empestimo_prof1`
    FOREIGN KEY (`prof_idProf`)
    REFERENCES `Biblioteca`.`prof` (`idProf`),
  CONSTRAINT `fk_empestimo_usuario1`
    FOREIGN KEY (`usuario_idUsuario`)
    REFERENCES `Biblioteca`.`usuario` (`idUsuario`))
ENGINE = InnoDB
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8mb3;


-- -----------------------------------------------------
-- Table `Biblioteca`.`devolucao`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Biblioteca`.`devolucao` (
  `idDevolucao` INT NOT NULL AUTO_INCREMENT,
  `DataDevolucao` DATE NOT NULL,
  `DataDevolvida` DATE NULL DEFAULT NULL,
  `StatusDevolucao` INT NOT NULL,
  `emprestimo_idEmprestimo` INT NOT NULL,
  PRIMARY KEY (`idDevolucao`),
  INDEX `fk_devolucao_empestimo1_idx` (`emprestimo_idEmprestimo` ASC) VISIBLE,
  CONSTRAINT `fk_devolucao_empestimo1`
    FOREIGN KEY (`emprestimo_idEmprestimo`)
    REFERENCES `Biblioteca`.`emprestimo` (`idEmprestimo`))
ENGINE = InnoDB
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8mb3;


-- -----------------------------------------------------
-- Table `Biblioteca`.`recomendacao`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Biblioteca`.`recomendacao` (
  `idRec` INT NOT NULL AUTO_INCREMENT,
  `LivroRec` VARCHAR(150) NOT NULL,
  `AutorRec` VARCHAR(150) NOT NULL,
  `CatRec` VARCHAR(150) NOT NULL,
  `ImgRec` BLOB NOT NULL,
  `CamRec` VARCHAR(200) NOT NULL,
  PRIMARY KEY (`idRec`))
ENGINE = MyISAM
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
