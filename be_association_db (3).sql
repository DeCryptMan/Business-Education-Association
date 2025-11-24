-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Ноя 24 2025 г., 12:00
-- Версия сервера: 10.4.32-MariaDB
-- Версия PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `be_association_db`
--

-- --------------------------------------------------------

--
-- Структура таблицы `contact_messages`
--

CREATE TABLE `contact_messages` (
  `id` int(11) NOT NULL,
  `reference` varchar(30) DEFAULT NULL,
  `full_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `topic` varchar(50) DEFAULT NULL,
  `message` text NOT NULL,
  `status` enum('new','processed') DEFAULT 'new',
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `contact_messages`
--

INSERT INTO `contact_messages` (`id`, `reference`, `full_name`, `email`, `phone`, `topic`, `message`, `status`, `created_at`) VALUES
(2, 'MSG-2025-9148', 'Edgar Варданович Gevorgyan', 'edgargevorgyan988@gmail.com', '091150501', 'partnership', 'xzcvzxcv', 'processed', '2025-11-20 12:21:28'),
(3, 'MSG-2025-8555', 'Edgar Варданович Gevorgyan', 'edgargevorgyan988@gmail.com', '091150501', 'partnership', 'test', 'new', '2025-11-20 14:49:24'),
(4, 'MSG-2025-6477', 'Edgar Варданович Gevorgyan', 'edgargevorgyan988@gmail.com', '+37491150501', 'other', 'фывфыв', 'new', '2025-11-21 11:22:46');

-- --------------------------------------------------------

--
-- Структура таблицы `events`
--

CREATE TABLE `events` (
  `id` int(11) NOT NULL,
  `title_hy` varchar(255) NOT NULL,
  `title_en` varchar(255) DEFAULT NULL,
  `description_hy` text DEFAULT NULL,
  `description_en` text DEFAULT NULL,
  `event_date` date NOT NULL,
  `start_time` time DEFAULT NULL,
  `location_hy` varchar(255) DEFAULT NULL,
  `location_en` varchar(255) DEFAULT NULL,
  `image_url` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `mentees`
--

CREATE TABLE `mentees` (
  `id` int(11) NOT NULL,
  `reference` varchar(30) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `profile_data` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`profile_data`)),
  `status` varchar(50) DEFAULT 'new',
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `mentees`
--

INSERT INTO `mentees` (`id`, `reference`, `full_name`, `email`, `phone`, `profile_data`, `status`, `created_at`) VALUES
(1, 'MTE-2025-9373', 'Edgar Варданович Gevorgyan', 'edgargevorgyan988@gmail.com', 'asd', '{\"csrf_token\":\"7aaf70f5e4f332ff9f9c9d73a9b940d31b9d1527a6711a74f999ce9e97fbc4ff\",\"fullName\":\"Edgar Варданович Gevorgyan\",\"birthInfo\":\"asd\",\"maritalStatus\":\"aasd\",\"children\":\"asd\",\"dependants\":\"asd\",\"careSituation\":[\"daycare\",\"nursing\",\"family\",\"other\"],\"orgName\":\"asd\",\"orgWebsite\":\"\",\"personalAddress\":\"16 Taxamas\",\"workAddress\":\"ASDASD\",\"postalCode\":\"0056\",\"phone\":\"091150501\",\"mobilePhone\":\"asd\",\"email\":\"edgargevorgyan988@gmail.com\",\"otherContact\":\"ASDASD\",\"currentOrg\":\"asd\",\"currentPosition\":\"asd\",\"employmentRate\":\"ASD\",\"activityField\":\"ASD\",\"orgStartYear\":\"ASD\",\"employeesCount\":\"ASD\",\"programResponsibility\":\"yes\",\"budgetResponsibility\":\"yes\",\"careerChangeInside\":\"yes\",\"memberships\":\"ASD\",\"volunteering\":\"ASD\",\"totalExperience\":\"ASD\",\"socialPlatforms\":[\"LinkedIn\",\"Instagram\"],\"prSupport\":\"yes\",\"currentActivityMain\":\"ASD\",\"currentResponsibilities\":\"ASD\",\"highestEducationYear\":\"ASD\",\"eduInstitution\":\"ASD\",\"vocationalInstitution\":\"ASD\",\"vocationalQualification\":\"ASD\",\"universityInstitution\":\"ASD\",\"universitySpeciality\":\"ASD\",\"universityQualification\":\"ASD\",\"academicDegree\":\"ASD\",\"activity[1][role]\":\"\",\"activity[1][duration]\":\"\",\"activity[1][field]\":\"\",\"activity[2][role]\":\"\",\"activity[2][duration]\":\"\",\"activity[2][field]\":\"\",\"activity[3][role]\":\"\",\"activity[3][duration]\":\"\",\"activity[3][field]\":\"\",\"activity[4][role]\":\"ASD\",\"activity[4][duration]\":\"ASD\",\"activity[4][field]\":\"\",\"activity[5][role]\":\"\",\"activity[5][duration]\":\"\",\"activity[5][field]\":\"ASD\",\"activity[6][role]\":\"\",\"activity[6][duration]\":\"\",\"activity[6][field]\":\"\",\"educationComments\":\"\",\"decisiveSteps\":\"ASDA\",\"careerOpportunityAssessment\":\"SD\",\"goalsShortTerm\":\"ASD\",\"goalsMidTerm\":\"ASD\",\"goalsLongTerm\":\"ASD\",\"programExpectations\":[\"careerGrowth\"],\"currentChallenges\":\"ASD\",\"skillsToDevelop\":\"ASD\",\"topics\":[\"conflictManagement\",\"businessPlanning\"],\"videoConferencingExperience\":\"ASD\",\"challengesForMentor\":\"ASD\",\"expectationsFromMentor\":\"ASD\",\"suggestionsToMentor\":\"ASD\",\"importantElements\":\"ASD\",\"previousPrograms\":\"yes\",\"previousProgramsDetails\":\"ASD\",\"supportOptions\":[\"space\",\"eventSupport\",\"companyVisit\"],\"recognizedByOrg\":\"withoutSupervisor\",\"infoSource\":[\"event\"],\"consentDataProcessing\":\"yes\",\"consentPhotos\":\"yes\",\"consentCompanyLogo\":\"yes\",\"publishData\":[\"name\",\"email\",\"phone\",\"company\",\"position\"],\"signaturePlaceDate\":\"ASDASD\",\"signature\":\"ASDASD\"}', 'approved', '2025-11-19 22:30:35'),
(2, 'MTE-2025-6827', 'Edgar Варданович Gevorgyan', 'edgargevorgyan988@gmail.com', '099084498', '{\"csrf_token\":\"7aaf70f5e4f332ff9f9c9d73a9b940d31b9d1527a6711a74f999ce9e97fbc4ff\",\"fullName\":\"Edgar Варданович Gevorgyan\",\"birthInfo\":\"asd\",\"maritalStatus\":\"aasd\",\"children\":\"asd\",\"dependants\":\"asd\",\"careSituation\":[\"daycare\",\"nursing\"],\"orgName\":\"asd\",\"orgWebsite\":\"\",\"personalAddress\":\"16 Taxamas\",\"workAddress\":\"ASDASD\",\"postalCode\":\"0056\",\"phone\":\"091150501\",\"mobilePhone\":\"099084498\",\"email\":\"edgargevorgyan988@gmail.com\",\"otherContact\":\"ASDASD\",\"currentOrg\":\"asd\",\"currentPosition\":\"asd\",\"employmentRate\":\"ASD\",\"activityField\":\"ASD\",\"orgStartYear\":\"ASD\",\"employeesCount\":\"ASD\",\"programResponsibility\":\"yes\",\"budgetResponsibility\":\"yes\",\"careerChangeInside\":\"yes\",\"memberships\":\"фыв\",\"volunteering\":\"ASD\",\"totalExperience\":\"ASD\",\"socialPlatforms\":[\"LinkedIn\",\"Other\"],\"prSupport\":\"yes\",\"currentActivityMain\":\"фыв\",\"currentResponsibilities\":\"фыв\",\"highestEducation\":\"secondary\",\"highestEducationYear\":\"ASD\",\"eduInstitution\":\"фыв\",\"vocationalInstitution\":\"фыв\",\"vocationalQualification\":\"ASD\",\"universityInstitution\":\"\",\"universitySpeciality\":\"ASD\",\"universityQualification\":\"ASD\",\"academicDegree\":\"ASD\",\"activity[1][role]\":\"\",\"activity[1][duration]\":\"\",\"activity[1][field]\":\"\",\"activity[2][role]\":\"\",\"activity[2][duration]\":\"\",\"activity[2][field]\":\"\",\"activity[3][role]\":\"\",\"activity[3][duration]\":\"\",\"activity[3][field]\":\"\",\"activity[4][role]\":\"ASD\",\"activity[4][duration]\":\"ASD\",\"activity[4][field]\":\"\",\"activity[5][role]\":\"\",\"activity[5][duration]\":\"\",\"activity[5][field]\":\"ASD\",\"activity[6][role]\":\"\",\"activity[6][duration]\":\"\",\"activity[6][field]\":\"\",\"educationComments\":\"\",\"decisiveSteps\":\"фыв\",\"careerOpportunityAssessment\":\"фыв\",\"goalsShortTerm\":\"фыв\",\"goalsMidTerm\":\"фыв\",\"goalsLongTerm\":\"фыв\",\"programExpectations\":[\"recognition\",\"teamImpact\"],\"currentChallenges\":\"фыв\",\"skillsToDevelop\":\"фыв\",\"topics\":[\"careerPlanning\",\"communication\",\"changeManagement\"],\"videoConferencingExperience\":\"фыв\",\"challengesForMentor\":\"фыв\",\"expectationsFromMentor\":\"фыв\",\"suggestionsToMentor\":\"фыв\",\"importantElements\":\"фыв\",\"previousPrograms\":\"yes\",\"previousProgramsDetails\":\"ASD\",\"supportOptions\":[\"space\",\"other\"],\"infoSource\":[\"other\"],\"consentDataProcessing\":\"yes\",\"consentPhotos\":\"yes\",\"consentCompanyLogo\":\"yes\",\"publishData\":[\"name\",\"email\",\"phone\",\"company\",\"position\"],\"signaturePlaceDate\":\"ASDASD\",\"signature\":\"ASDASD\"}', 'rejected', '2025-11-19 22:35:40'),
(3, 'MTE-2025-6366', 'Edgar Варданович Gevorgyan', 'edgargevorgyan988@gmail.com', '091150501', '{\"csrf_token\":\"221168e02cf29e4ac97442e852411e520646e6efdecfde7910a60c51853784ca\",\"fullName\":\"Edgar Варданович Gevorgyan\",\"birthInfo\":\"\",\"maritalStatus\":\"\",\"children\":\"\",\"dependants\":\"\",\"email\":\"edgargevorgyan988@gmail.com\",\"phone\":\"091150501\",\"personalAddress\":\"16 Taxamas\",\"postalCode\":\"0056\",\"otherContact\":\"\",\"currentOrg\":\"\",\"currentPosition\":\"\",\"currentActivityMain\":\"\",\"eduInstitution\":\"\",\"educationComments\":\"\",\"decisiveSteps\":\"\",\"careerOpportunityAssessment\":\"\",\"goalsShortTerm\":\"\",\"goalsLongTerm\":\"\",\"skillsToDevelop\":\"\",\"expectationsFromMentor\":\"\",\"videoConferencingExperience\":\"\",\"importantElements\":\"\",\"consentDataProcessing\":\"yes\",\"signaturePlaceDate\":\"25-1905\",\"signature\":\"ASDASD\"}', 'new', '2025-11-21 15:50:55'),
(4, 'MTE-2025-2402', 'Unknown', 'edgargevorgyan988@gmail.com', '091150501', '{\"full_name\":\"Edgar Варданович Gevorgyan\",\"email\":\"edgargevorgyan988@gmail.com\",\"phone\":\"091150501\",\"profile_data\":\"{\\\"fullName\\\":\\\"Edgar Варданович Gevorgyan\\\",\\\"birthInfo\\\":\\\"\\\",\\\"maritalStatus\\\":\\\"\\\",\\\"children\\\":\\\"\\\",\\\"dependants\\\":\\\"\\\",\\\"email\\\":\\\"edgargevorgyan988@gmail.com\\\",\\\"phone\\\":\\\"091150501\\\",\\\"personalAddress\\\":\\\"16 Taxamas\\\",\\\"postalCode\\\":\\\"0056\\\",\\\"otherContact\\\":\\\"\\\",\\\"currentOrg\\\":\\\"\\\",\\\"currentPosition\\\":\\\"\\\",\\\"currentActivityMain\\\":\\\"\\\",\\\"eduInstitution\\\":\\\"\\\",\\\"educationComments\\\":\\\"\\\",\\\"decisiveSteps\\\":\\\"\\\",\\\"careerOpportunityAssessment\\\":\\\"\\\",\\\"goalsShortTerm\\\":\\\"\\\",\\\"goalsLongTerm\\\":\\\"\\\",\\\"skillsToDevelop\\\":\\\"\\\",\\\"expectationsFromMentor\\\":\\\"\\\",\\\"videoConferencingExperience\\\":\\\"\\\",\\\"importantElements\\\":\\\"\\\",\\\"consentDataProcessing\\\":\\\"yes\\\",\\\"signaturePlaceDate\\\":\\\"25-1905\\\",\\\"signature\\\":\\\"ASDASD\\\"}\"}', 'approved', '2025-11-21 16:12:11');

-- --------------------------------------------------------

--
-- Структура таблицы `mentors`
--

CREATE TABLE `mentors` (
  `id` int(11) NOT NULL,
  `reference` varchar(30) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `organization` varchar(150) DEFAULT NULL,
  `position` varchar(150) DEFAULT NULL,
  `profile_data` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`profile_data`)),
  `status` varchar(50) DEFAULT 'new',
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `mentors`
--

INSERT INTO `mentors` (`id`, `reference`, `full_name`, `email`, `phone`, `organization`, `position`, `profile_data`, `status`, `created_at`) VALUES
(1, 'MTR-2025-6006', 'Edgar Варданович Gevorgyan', 'edgargevorgyan988@gmail.com', '1 450-410-6189', '', '', '{\"csrf_token\":\"7aaf70f5e4f332ff9f9c9d73a9b940d31b9d1527a6711a74f999ce9e97fbc4ff\",\"fullName\":\"Edgar Варданович Gevorgyan\",\"orgName\":\"\",\"address\":\"16 Taxamas\",\"postalCode\":\"0056\",\"phone\":\"091150501\",\"mobilePhone\":\"1 450-410-6189\",\"email\":\"edgargevorgyan988@gmail.com\",\"otherContact\":\"ASDASD\",\"website\":\"\",\"birthDate\":\"05.09.2008\",\"children\":\"\",\"dependants\":\"asd\",\"careSituation\":[\"kindergarten\"],\"careGivers\":[\"employed\"],\"careGiversOther\":\"\",\"higherEduInstitution\":\"sdf\",\"faculty\":\"sdf\",\"major\":\"sdf\",\"graduationYear\":\"sdf\",\"profTrainingField\":\"sdf\",\"profQualificationYear\":\"asdf\",\"trainingOrg\":\"asdf\",\"vocationalInstitution\":\"sdf\",\"currentOrg\":\"\",\"currentAddress\":\"\",\"activityField\":\"\",\"currentPosition\":\"\",\"orgDuration\":\"\",\"employeesTotal\":\"\",\"subordinatesCount\":\"\",\"positionPurpose\":\"\",\"memberships\":\"\",\"volunteering\":\"\",\"career[1][role]\":\"\",\"career[1][duration]\":\"\",\"career[1][field]\":\"\",\"career[2][role]\":\"\",\"career[2][duration]\":\"\",\"career[2][field]\":\"\",\"career[3][role]\":\"\",\"career[3][duration]\":\"\",\"career[3][field]\":\"\",\"career[4][role]\":\"\",\"career[4][duration]\":\"\",\"career[4][field]\":\"\",\"career[5][role]\":\"\",\"career[5][duration]\":\"\",\"career[5][field]\":\"\",\"career[6][role]\":\"\",\"career[6][duration]\":\"\",\"career[6][field]\":\"\",\"careerComments\":\"\",\"menteeTopicsOther\":\"\",\"menteeField\":\"\",\"expectationsFromMentee\":\"\",\"mentorExperienceDetails\":\"\",\"programExpectationsOther\":\"\",\"mentorQualitiesOther\":\"\",\"whatIsLeadership\":\"\",\"seminarTopicsOther\":\"\",\"supportLecturerTopics\":\"\",\"supportBestPracticesTopics\":\"\",\"supportProgramOther\":\"\",\"meetingFrequencyOther\":\"\",\"additionalComments\":\"\",\"consentDataProcessing\":\"yes\",\"consentPhotos\":\"yes\",\"consentCompanyLogo\":\"yes\",\"consentDataPublication\":\"yes\",\"publishFirstName\":\"\",\"publishLastName\":\"\",\"publishBirthDate\":\"\",\"publishEmail\":\"\",\"publishPhone\":\"\",\"publishCompanyRole\":\"\",\"placeDate\":\"sdf\",\"signature\":\"asdf\"}', 'approved', '2025-11-19 23:21:33'),
(2, 'MTR-2025-1365', 'Edgar Варданович Gevorgyan', 'edgargevorgyan988@gmail.com', '1 450-410-6189', '', 'sd', '{\"csrf_token\":\"c09ab20162df1ab255826407d3986c494074758c3472e3ab404e43a9b1ae374a\",\"fullName\":\"Edgar Варданович Gevorgyan\",\"orgName\":\"\",\"address\":\"16 Taxamas\",\"postalCode\":\"0056\",\"phone\":\"091150501\",\"mobilePhone\":\"1 450-410-6189\",\"email\":\"edgargevorgyan988@gmail.com\",\"otherContact\":\"ASDASD\",\"website\":\"\",\"birthDate\":\"05.09.2008\",\"children\":\"\",\"dependants\":\"asd\",\"careSituation\":[\"kindergarten\",\"nursing\"],\"careGivers\":[\"selfEmployed\"],\"careGiversOther\":\"\",\"higherEduInstitution\":\"\",\"faculty\":\"sdf\",\"major\":\"sdf\",\"graduationYear\":\"sdf\",\"profTrainingField\":\"sdf\",\"profQualificationYear\":\"asdf\",\"trainingOrg\":\"asdf\",\"vocationalInstitution\":\"sdf\",\"currentOrg\":\"asd\",\"currentAddress\":\"asda\",\"activityField\":\"asd\",\"currentPosition\":\"sd\",\"orgDuration\":\"asd\",\"employeesTotal\":\"asd\",\"subordinatesCount\":\"asd\",\"positionPurpose\":\"asd\",\"memberships\":\"as\",\"volunteering\":\"dasd\",\"career[1][role]\":\"asd\",\"career[1][duration]\":\"asd\",\"career[1][field]\":\"asd\",\"career[2][role]\":\"\",\"career[2][duration]\":\"\",\"career[2][field]\":\"\",\"career[3][role]\":\"\",\"career[3][duration]\":\"\",\"career[3][field]\":\"\",\"career[4][role]\":\"\",\"career[4][duration]\":\"\",\"career[4][field]\":\"\",\"career[5][role]\":\"\",\"career[5][duration]\":\"\",\"career[5][field]\":\"\",\"career[6][role]\":\"\",\"career[6][duration]\":\"\",\"career[6][field]\":\"\",\"careerComments\":\"\",\"menteeTopics\":[\"communication\",\"other\"],\"menteeTopicsOther\":\"\",\"menteeField\":\"\",\"expectationsFromMentee\":\"\",\"hasMentorExperience\":\"no\",\"mentorExperienceDetails\":\"\",\"programExpectations\":[\"nextGenerationLeaders\",\"otherCompaniesInsights\"],\"programExpectationsOther\":\"\",\"mentorQualities\":[\"experienceKnowledge\",\"inspirationMotivation\",\"responsibility\"],\"mentorQualitiesOther\":\"\",\"whatIsLeadership\":\"\",\"seminarTopics\":[\"nonverbalCommunication\",\"criticalDiscussion\"],\"seminarTopicsOther\":\"\",\"supportProgram\":[\"lecturer\"],\"supportLecturerTopics\":\"\",\"supportBestPracticesTopics\":\"\",\"supportProgramOther\":\"\",\"meetingFrequency\":\"weekly\",\"meetingFrequencyOther\":\"\",\"additionalComments\":\"\",\"consentDataProcessing\":\"yes\",\"consentPhotos\":\"yes\",\"consentCompanyLogo\":\"yes\",\"consentDataPublication\":\"yes\",\"publishFirstName\":\"asd\",\"publishLastName\":\"asdasd\",\"publishBirthDate\":\"sda\",\"publishEmail\":\"asd\",\"publishPhone\":\"asda\",\"publishCompanyRole\":\"sd\",\"placeDate\":\"sdf\",\"signature\":\"asdf\"}', 'new', '2025-11-21 14:03:49'),
(3, 'MTR-2025-4808', 'Edgar Варданович Gevorgyan', 'edgargevorgyan988@gmail.com', '091150501', '', '', '{\"csrf_token\":\"221168e02cf29e4ac97442e852411e520646e6efdecfde7910a60c51853784ca\",\"fullName\":\"Edgar Варданович Gevorgyan\",\"birthInfo\":\"\",\"email\":\"edgargevorgyan988@gmail.com\",\"phone\":\"091150501\",\"linkedin\":\"\",\"website\":\"\",\"address\":\"16 Taxamas\",\"currentOrg\":\"BlackGonza\",\"position\":\"asdasdasd\",\"industry\":\"\",\"experienceYears\":\"\",\"bio\":\"\",\"university\":\"\",\"degree\":\"\",\"otherSkills\":\"\",\"mentoringDesc\":\"\",\"motivation\":\"asdasdasd\",\"expectations\":\"\",\"hoursPerMonth\":\"\",\"consentDataProcessing\":\"yes\",\"consentCodeOfConduct\":\"yes\",\"signature\":\"ASDASD\"}', 'new', '2025-11-21 16:03:53'),
(4, 'MTR-2025-5767', 'Unknown', 'edgargevorgyan988@gmail.com', '1 450-410-6189', '', '', '{\"full_name\":\"Edgar Варданович Gevorgyan\",\"email\":\"edgargevorgyan988@gmail.com\",\"phone\":\"1 450-410-6189\",\"profile_data\":\"{\\\"fullName\\\":\\\"Edgar Варданович Gevorgyan\\\",\\\"birthInfo\\\":\\\"\\\",\\\"email\\\":\\\"edgargevorgyan988@gmail.com\\\",\\\"phone\\\":\\\"1 450-410-6189\\\",\\\"linkedin\\\":\\\"\\\",\\\"website\\\":\\\"\\\",\\\"address\\\":\\\"16 Taxamas\\\",\\\"currentOrg\\\":\\\"BlackGonza\\\",\\\"position\\\":\\\"asdasdasd\\\",\\\"industry\\\":\\\"\\\",\\\"experienceYears\\\":\\\"\\\",\\\"bio\\\":\\\"\\\",\\\"university\\\":\\\"\\\",\\\"degree\\\":\\\"\\\",\\\"otherSkills\\\":\\\"\\\",\\\"mentoringDesc\\\":\\\"\\\",\\\"motivation\\\":\\\"фывфЫВ\\\",\\\"expectations\\\":\\\"\\\",\\\"hoursPerMonth\\\":\\\"\\\",\\\"consentDataProcessing\\\":\\\"yes\\\",\\\"consentCodeOfConduct\\\":\\\"yes\\\",\\\"signature\\\":\\\"ASDASD\\\"}\"}', 'new', '2025-11-21 16:11:44'),
(5, 'MTR-2025-5383', 'Unknown', 'edgargevorgyan988@gmail.com', '1 450-410-6189', '', '', '{\"full_name\":\"Edgar Варданович Gevorgyan\",\"email\":\"edgargevorgyan988@gmail.com\",\"phone\":\"1 450-410-6189\",\"profile_data\":\"{\\\"fullName\\\":\\\"Edgar Варданович Gevorgyan\\\",\\\"birthInfo\\\":\\\"\\\",\\\"email\\\":\\\"edgargevorgyan988@gmail.com\\\",\\\"phone\\\":\\\"1 450-410-6189\\\",\\\"linkedin\\\":\\\"\\\",\\\"website\\\":\\\"\\\",\\\"address\\\":\\\"16 Taxamas\\\",\\\"currentOrg\\\":\\\"BlackGonza\\\",\\\"position\\\":\\\"asdasdasd\\\",\\\"industry\\\":\\\"\\\",\\\"experienceYears\\\":\\\"\\\",\\\"bio\\\":\\\"\\\",\\\"university\\\":\\\"\\\",\\\"degree\\\":\\\"\\\",\\\"expertise\\\":[\\\"it\\\"],\\\"otherSkills\\\":\\\"\\\",\\\"mentoringDesc\\\":\\\"\\\",\\\"motivation\\\":\\\"фыв\\\",\\\"expectations\\\":\\\"\\\",\\\"hoursPerMonth\\\":\\\"\\\",\\\"consentDataProcessing\\\":\\\"yes\\\",\\\"consentCodeOfConduct\\\":\\\"yes\\\",\\\"signature\\\":\\\"ASDASD\\\"}\"}', 'new', '2025-11-22 12:45:52'),
(6, 'MTR-2025-7243', 'Edgar Варданович Gevorgyan', 'edgargevorgyan988@gmail.com', '1 450-410-6189', 'BlackGonza', 'asdasdasd', '{\"fullName\":\"Edgar Варданович Gevorgyan\",\"email\":\"edgargevorgyan988@gmail.com\",\"phone\":\"1 450-410-6189\",\"orgName\":\"BlackGonza\",\"currentPosition\":\"asdasdasd\",\"profile_data\":\"{\\\"fullName\\\":\\\"Edgar Варданович Gevorgyan\\\",\\\"birthInfo\\\":\\\"\\\",\\\"email\\\":\\\"edgargevorgyan988@gmail.com\\\",\\\"phone\\\":\\\"1 450-410-6189\\\",\\\"linkedin\\\":\\\"\\\",\\\"website\\\":\\\"\\\",\\\"address\\\":\\\"16 Taxamas\\\",\\\"currentOrg\\\":\\\"BlackGonza\\\",\\\"position\\\":\\\"asdasdasd\\\",\\\"industry\\\":\\\"\\\",\\\"experienceYears\\\":\\\"\\\",\\\"bio\\\":\\\"\\\",\\\"university\\\":\\\"\\\",\\\"degree\\\":\\\"\\\",\\\"otherSkills\\\":\\\"\\\",\\\"mentoringDesc\\\":\\\"\\\",\\\"motivation\\\":\\\"asdasd\\\",\\\"expectations\\\":\\\"\\\",\\\"hoursPerMonth\\\":\\\"\\\",\\\"consentDataProcessing\\\":\\\"yes\\\",\\\"consentCodeOfConduct\\\":\\\"yes\\\",\\\"signature\\\":\\\"ASDASD\\\"}\"}', 'approved', '2025-11-22 12:48:53'),
(7, 'MTR-2025-9519', 'Edgar Варданович Gevorgyan', 'edgargevorgyan988@gmail.com', '1 450-410-6189', 'BlackGonza', 'asdasdasd', '{\"fullName\":\"Edgar Варданович Gevorgyan\",\"email\":\"edgargevorgyan988@gmail.com\",\"phone\":\"1 450-410-6189\",\"orgName\":\"BlackGonza\",\"currentPosition\":\"asdasdasd\",\"profile_data\":\"{\\\"fullName\\\":\\\"Edgar Варданович Gevorgyan\\\",\\\"birthInfo\\\":\\\"\\\",\\\"email\\\":\\\"edgargevorgyan988@gmail.com\\\",\\\"phone\\\":\\\"1 450-410-6189\\\",\\\"linkedin\\\":\\\"\\\",\\\"website\\\":\\\"\\\",\\\"address\\\":\\\"16 Taxamas\\\",\\\"currentOrg\\\":\\\"BlackGonza\\\",\\\"position\\\":\\\"asdasdasd\\\",\\\"industry\\\":\\\"\\\",\\\"experienceYears\\\":\\\"\\\",\\\"bio\\\":\\\"\\\",\\\"university\\\":\\\"\\\",\\\"degree\\\":\\\"\\\",\\\"otherSkills\\\":\\\"\\\",\\\"mentoringDesc\\\":\\\"\\\",\\\"motivation\\\":\\\"фыв\\\",\\\"expectations\\\":\\\"\\\",\\\"hoursPerMonth\\\":\\\"\\\",\\\"consentDataProcessing\\\":\\\"yes\\\",\\\"consentCodeOfConduct\\\":\\\"yes\\\",\\\"signature\\\":\\\"ASDASD\\\"}\"}', 'new', '2025-11-22 12:53:06'),
(8, 'MTR-2025-5271', 'Edgar Варданович Gevorgyan', 'edgargevorgyan988@gmail.com', '1 450-410-6189', 'BlackGonza', 'asdasdasd', '{\"fullName\":\"Edgar Варданович Gevorgyan\",\"email\":\"edgargevorgyan988@gmail.com\",\"phone\":\"1 450-410-6189\",\"orgName\":\"BlackGonza\",\"currentPosition\":\"asdasdasd\",\"profile_data\":\"{\\\"fullName\\\":\\\"Edgar Варданович Gevorgyan\\\",\\\"birthInfo\\\":\\\"\\\",\\\"email\\\":\\\"edgargevorgyan988@gmail.com\\\",\\\"phone\\\":\\\"1 450-410-6189\\\",\\\"linkedin\\\":\\\"\\\",\\\"website\\\":\\\"\\\",\\\"address\\\":\\\"16 Taxamas\\\",\\\"currentOrg\\\":\\\"BlackGonza\\\",\\\"position\\\":\\\"asdasdasd\\\",\\\"industry\\\":\\\"asd\\\",\\\"experienceYears\\\":\\\"12\\\",\\\"bio\\\":\\\"asd\\\",\\\"university\\\":\\\"asdA\\\",\\\"degree\\\":\\\"ASDASD\\\",\\\"expertise\\\":[\\\"management\\\",\\\"it\\\",\\\"softSkills\\\"],\\\"otherSkills\\\":\\\"\\\",\\\"hasMentored\\\":\\\"yes\\\",\\\"mentoringDesc\\\":\\\"ASDASD\\\",\\\"motivation\\\":\\\"ASDASDASDASD\\\",\\\"expectations\\\":\\\"ASDASD\\\",\\\"hoursPerMonth\\\":\\\"10\\\",\\\"meetingFormat\\\":\\\"offline\\\",\\\"consentDataProcessing\\\":\\\"yes\\\",\\\"consentCodeOfConduct\\\":\\\"yes\\\",\\\"signature\\\":\\\"ASDASD\\\"}\"}', 'approved', '2025-11-22 13:09:14');

-- --------------------------------------------------------

--
-- Структура таблицы `news`
--

CREATE TABLE `news` (
  `id` int(11) NOT NULL,
  `slug` varchar(150) NOT NULL,
  `title_hy` varchar(255) NOT NULL,
  `title_en` varchar(255) DEFAULT '',
  `excerpt_hy` text DEFAULT NULL,
  `excerpt_en` text DEFAULT NULL,
  `body_hy` longtext DEFAULT NULL,
  `body_en` text DEFAULT NULL,
  `published_at` datetime DEFAULT current_timestamp(),
  `image_url` varchar(255) DEFAULT NULL,
  `is_published` tinyint(1) DEFAULT 1,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `news`
--

INSERT INTO `news` (`id`, `slug`, `title_hy`, `title_en`, `excerpt_hy`, `excerpt_en`, `body_hy`, `body_en`, `published_at`, `image_url`, `is_published`, `created_at`) VALUES
(16, 'test1', '«Бизнес и образование Ассоциация» исцеляет связи, Упомянутые и образовательные семинары по развитию сотрудничества', 'esi anglerenna', '202520-22 марта «Ассоциации бизнеса и образования» (С этого момента ассоциация) Германия в Ленбург-Форкерании Центр федеральной региональной экономики (Черный) В сочетании с, В рамках программы партнерства ассоциации, Проводились мастерские.', 'angl', '202520-22 марта «Ассоциации бизнеса и образования» (С этого момента ассоциация) Германия в Ленбург-Форкерании Центр федеральной региональной экономики (Черный) В сочетании с, В рамках программы партнерства ассоциации, Проводились мастерские.\r\nВо время семинаров участники обучались инновационным методам связей с общественностью и маркетингом, менталитет, Стратегическое планирование и годовые направления развития.\r\n\r\nКроме, Были обсуждены возможности углубления сотрудничества между образованием и бизнесом, Способы представить лучший международный опыт, А также дальнейшие планы ассоциации.\r\nТакие меры имеют большое значение для содействия эффективным связям между образованием и бизнесом и содействие взаимовыгодным сотрудничеству.\r\n\r\n\r\n', 'angliski', '2025-11-20 00:00:00', 'assets/uploads/news/upload_691ef29974f35_1763635865.jpg', 0, '2025-11-20 14:51:05'),
(17, 'hayeren-barev', 'Հայերեն Բարև', 'Angleren barev', 'Հայերեն նկարագրություն', 'angleren nkaragrutyun', 'Հայերեն Տեքստ', 'angleren text', '2025-11-03 00:00:00', 'assets/uploads/news/upload_692181c608058_1763803590.jpg', 0, '2025-11-22 13:26:30'),
(18, 'bka-mentorotyan-tsragri-mijocov-masnagitakan-canceri-zargacom', 'ԲԿԱ Մենթորության Ծրագրի միջոցով Մասնագիտական Ցանցերի Զարգացում', 'BEA Mentoring Program Strengthens Professional Networks', '2025 թվականի մարտի 12-ին, «Բիզնես և Կրթություն Ասոցիացիան» (ԲԿԱ) կազմակերպեց\r\nՄենթորության Ծրագրի Նեթվորքինգ Միջոցառում՝ «Ասոցիացիայի Գործընկերության Ծրագրի»\r\nշրջանակներում: Միջոցառումը նպատակ ուներ ամրապնդելու համագործակցությունը ԲԿԱ-ի անդամ\r\nմենթորների և մենթիների միջև՝ խթանելով մասնագիտական աճը և նոր ցանցերի ձևավորումը:', 'On March 12, 2025, the Business and Education Association (BEA) hosted a Networking Event in Yerevan as part of its Mentoring Program within the Association Partnership Project. The gathering aimed to strengthen collaboration between mentors and mentees, fostering professional development and expanding networking opportunities', '2025 թվականի մարտի 12-ին, «Բիզնես և Կրթություն Ասոցիացիան» (ԲԿԱ) կազմակերպեց\r\nՄենթորության Ծրագրի Նեթվորքինգ Միջոցառում՝ «Ասոցիացիայի Գործընկերության Ծրագրի»\r\nշրջանակներում: Միջոցառումը նպատակ ուներ ամրապնդելու համագործակցությունը ԲԿԱ-ի անդամ\r\nմենթորների և մենթիների միջև՝ խթանելով մասնագիտական աճը և նոր ցանցերի ձևավորումը:\r\nՄիջոցառմանը մասնակցեցին գործարարներ, ՄԿՈւ հաստատությունների տնօրեններ, կրթական\r\nոլորտի ներկայացուցիչներ, ինչպես նաև ԲԿԱ գործընկերներ: Բացման խոսքում ԲԿԱ նախագահ Մարինե\r\nԺամկոչյանը ընդգծեց մենթորության և նեթվորքինգի կարևորությունը՝ մասնագիտական աճի և փորձի\r\nփոխանակման մեջ: Նա ներկայացրեց Մենթորության Ծրագրի ընթացիկ փուլը, միջազգային փորձը և\r\nզարգացման հեռանկարները:\r\nԱյնուհետև, Սուսաննա Խաչատրյանը, ԲԿԱ խորհրդի անդամը և փորձագետը, ներկայացրեց\r\nՄենթորության Ծրագրի ռազմավարությունը՝ անդրադառնալով ծրագրի նպատակներին ու\r\nհնարավորություններին, որոնք այն բացում է մասնակիցների համար:\r\nՄիջոցառման ընթացքում ձևավորվեցին հինգ խմբեր, որոնք քննարկեցին հետևյալ թեմաները՝\r\n Առաջնորդության զարգացում- Մենթիների համար կարևոր երեք առաջնորդական մարտահրավերներ և\r\nմենթորների դերը դրանց հաղթահարման մեջ:\r\n Կարիերայի աճ- Մենթորի աջակցությամբ կարիերայի «ճանապարհային քարտեզի» ստեղծում՝\r\nնպատակների և զարգացման ծրագրերի սահմանմամբ:\r\n Մարտահրավերների հաղթահարում- Մենթորությունը որպես դիմակայության և խնդիրների լուծման\r\nգործիք:\r\n Ցանցային հմտություններ- Մենթիների մասնագիտական կապեր հաստատելու սխալների\r\nվերլուծությունը և մենթորների աջակցությունը:\r\n Սոցիալական ձեռնարկատիրություն- Մենթորությունը՝ որպես ձեռնարկատիրության զարգացման\r\nկարևոր գործիք:\r\nԲԿԱ նախագահ Մարինե Ժամկոչյանը ամփոփեց քննարկումները՝ առանձնացնելով համագործակցության\r\nկարևորագույն կետերը՝ փոխադարձ վստահությունը, նպատակների հստակ սահմանումը և շարունակական\r\nուսուցման անհրաժեշտությունը: Նա կարևորեց Մենթորության Ծրագրի կարիքը՝ ոչ միայն մասնագիտական\r\nաճի համար, այլև կրթության և գործատուների միջև համագործակցության խթանման համար:\r\nՄիջոցառումը հնարավորություն ընձեռեց մասնակիցներին՝ ստեղծել նոր կապեր, բացահայտել նոր\r\nհնարավորություններ և շարունակել իրենց մասնագիտական զարգացումը։ «Բիզնես և Կրթություն\r\n\r\nԱսոցիացիան» շարունակելու է իրականացնել նմանատիպ միջոցառումներ՝ ամրապնդելու կրթության և\r\nբիզնեսի միջև փոխշահավետ համագործակցությունը։', 'The event brought together business leaders, VET institution directors, educators, and industry partners, creating a dynamic platform for knowledge exchange. Marine Jamkochian, President of BEA, opened the session by highlighting the importance of networking in professional growth and sharing insights on the Mentoring Program’s progress and global best practices. Susanna Khachatryan, BEA Board Member, followed with an overview of the program’s strategy, emphasizing its role in bridging education and industry.\r\n\r\nTo encourage interactive learning, participants engaged in five thematic group discussions:\r\nLeadership Development – Addressing key leadership challenges and strategies for mentors to guide mentees.\r\nCareer Growth – Creating career roadmaps and tackling obstacles such as skill gaps and networking limitations.\r\nOvercoming Challenges – Exploring mentorship as a tool for resilience and problem-solving.\r\nNetworking Skills – Enhancing professional connections and crafting effective self-introductions.\r\nSocial Entrepreneurship – Examining mentorship’s role in fostering impactful, sustainable businesses.\r\n\r\nEach group proposed practical solutions, reinforcing key mentorship principles: mutual trust, goal alignment, lifelong learning, and collaboration between education and industry.\r\n\r\nSummarizing the discussions, Marine Jamkochian reiterated the program’s crucial role in bridging the gap between VET institutions and employers, ensuring a more integrated and cooperative professional ecosystem. Events like these serve as catalysts for new opportunities, career growth, and industry insights, reinforcing BEA’s commitment to fostering mentorship and professional development.\r\n\r\nBy promoting mentoring, lifelong learning and cross-sector collaboration, BEA continues to empower individuals and organizations, building a more skilled, dynamic, and connected workforce.\r\n', '2025-03-12 00:00:00', 'assets/uploads/news/upload_692310b569122_1763905717.jpg', 1, '2025-11-23 17:48:37');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `role` varchar(20) DEFAULT 'admin'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `email`, `password_hash`, `role`) VALUES
(1, 'admin@be-association.am', '$2y$12$E.jjJgkDaKytcSPQoKJtj.rGigw6Bw2gUp1sAor27gPsFEj/3YNuW', 'admin'),
(2, 'admin@admin.am', '$2y$10$dBaL7lrah5F/BeIwjUVKI.MO75oUwLRkKv.uy.ZU4vmEIdgEfjWku', 'admin');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `contact_messages`
--
ALTER TABLE `contact_messages`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `mentees`
--
ALTER TABLE `mentees`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `mentors`
--
ALTER TABLE `mentors`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `slug` (`slug`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `contact_messages`
--
ALTER TABLE `contact_messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `events`
--
ALTER TABLE `events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `mentees`
--
ALTER TABLE `mentees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `mentors`
--
ALTER TABLE `mentors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT для таблицы `news`
--
ALTER TABLE `news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
