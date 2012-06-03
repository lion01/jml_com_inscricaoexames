
-- -----------------------------------------------------
-- Table `#__inscricaoexames_cursos`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `#__inscricaoexames_cursos` ;

CREATE  TABLE IF NOT EXISTS `#__inscricaoexames_cursos` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `designacao` VARCHAR(100) NOT NULL ,
  `sigla` VARCHAR(10) NULL ,
  PRIMARY KEY (`id`) ,
  UNIQUE INDEX `designacao_UNIQUE` (`designacao` ASC) )
ENGINE = InnoDB;

-- -----------------------------------------------------
-- Table `#__inscricaoexames_alunos`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `#__inscricaoexames_alunos` ;

CREATE  TABLE IF NOT EXISTS `#__inscricaoexames_alunos` (
  `id` INT NULL ,
  `bi` INT NOT NULL ,
  `nome` VARCHAR(100) NOT NULL ,
  `cursos_id` INT NULL DEFAULT NULL ,
  INDEX `fk_alunos_cursos` (`cursos_id` ASC) ,
  PRIMARY KEY (`bi`) ,
  CONSTRAINT `fk_alunos_cursos`
    FOREIGN KEY (`cursos_id` )
    REFERENCES `#__inscricaoexames_cursos` (`id` )
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB


-- -----------------------------------------------------
-- Table `#__inscricaoexames_disciplinas`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `#__inscricaoexames_disciplinas` ;

CREATE  TABLE IF NOT EXISTS `#__inscricaoexames_disciplinas` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `designacao` VARCHAR(100) NOT NULL ,
  PRIMARY KEY (`id`) ,
  UNIQUE INDEX `designacao_UNIQUE` (`designacao` ASC) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `#__inscricaoexames_modulos`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `#__inscricaoexames_modulos` ;

CREATE  TABLE IF NOT EXISTS `#__inscricaoexames_modulos` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `numero` SMALLINT UNSIGNED NULL ,
  `designacao` VARCHAR(100) NULL ,
  `disciplinas_id` INT UNSIGNED NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_modulos_disciplinas` (`disciplinas_id` ASC) ,
  CONSTRAINT `fk_modulos_disciplinas`
    FOREIGN KEY (`disciplinas_id` )
    REFERENCES `#__inscricaoexames_disciplinas` (`id` )
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `#__inscricaoexames_inscricoes`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `#__inscricaoexames_inscricoes` ;

CREATE  TABLE IF NOT EXISTS `#__inscricaoexames_inscricoes` (
  `alunos_bi` INT NOT NULL ,
  `modulos_id` INT NOT NULL ,
  PRIMARY KEY (`alunos_bi`, `modulos_id`) ,
  INDEX `fk_inscricoes_alunos` (`alunos_bi` ASC) ,
  INDEX `fk_inscricoes_modulos` (`modulos_id` ASC) ,
  CONSTRAINT `fk_inscricoes_alunos`
    FOREIGN KEY (`alunos_bi` )
    REFERENCES `#__inscricaoexames_alunos` (`bi` )
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_inscricoes_modulos`
    FOREIGN KEY (`modulos_id` )
    REFERENCES `#__inscricaoexames_modulos` (`id` )
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB


-- -----------------------------------------------------
-- Table `#__inscricaoexames_cursos_disciplinas`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `#__inscricaoexames_cursos_disciplinas` ;

CREATE  TABLE IF NOT EXISTS `#__inscricaoexames_cursos_disciplinas` (
  `cursos_id` INT UNSIGNED NOT NULL ,
  `disciplinas_id` INT UNSIGNED NOT NULL ,
  PRIMARY KEY (`cursos_id`, `disciplinas_id`) ,
  INDEX `fk_cursos_disciplinas_disciplinas` (`disciplinas_id` ASC) ,
  INDEX `fk_cursos_disciplinas_cursos` (`cursos_id` ASC) ,
  CONSTRAINT `fk_cursos_disciplinas_cursos`
    FOREIGN KEY (`cursos_id` )
    REFERENCES `#__inscricaoexames_cursos` (`id` )
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_cursos_disciplinas_disciplinas`
    FOREIGN KEY (`disciplinas_id` )
    REFERENCES `#__inscricaoexames_disciplinas` (`id` )
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `#__inscricaoexames_grupos`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `#__inscricaoexames_grupos` ;

CREATE  TABLE IF NOT EXISTS `#__inscricaoexames_grupos` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `designacao` VARCHAR(100) NULL ,
  `usergroups_id` INT UNSIGNED,
  PRIMARY KEY (`id`) ,
  INDEX `fk_joomla_groups_id` (`usergroups_id` ASC) ,
  CONSTRAINT `fk_joomla_groups_id`
    FOREIGN KEY (`usergroups_id` )
    REFERENCES `#__usergroups` (`id` )
    ON DELETE SET NULL
)
ENGINE = InnoDB;

INSERT INTO `#__inscricaoexames_grupos` (`designacao`) VALUES ('ALUNOS');
INSERT INTO `#__inscricaoexames_grupos` (`designacao`) VALUES ('SECRETARIA');




