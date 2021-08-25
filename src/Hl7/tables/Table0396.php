<?php
/**
 * Created by PhpStorm.
 * User: Menno
 * Date: 30-1-2019
 * Time: 00:24
 */

namespace mmerlijn\msg\src\Hl7\tables;


class Table0396 extends Table
{
    protected static $name="Coding system";
    protected static $table=[
        'L'=>'Local general code',
        'LN'=>'Logical Observation Identifier Names and Codes (LOINC®)',
        /*

ACR	American College of Radiology finding codes
ART	WHO Adverse Reaction Terms
ANS+	HL7 set of units of measure
AS4	ASTM E1238/ E1467 Universal
AS4E	AS4 Neurophysiology Codes
ATC	American Type Culture Collection
C4	CPT-4
C5	CPT-5
CAS	Chemical abstract codes
CD2	CDT-2 Codes
CDCA	CDC Analyte Codes
CDCM	CDC Methods/Instruments Codes
CDS	CDC Surveillance
CE	CEN ECG diagnostic codes
CLP	CLIP
CPTM	CPT Modifier Code
CST	COSTART
CVX	CDC Vaccine Codes
DCM	DICOM Controlled Terminology
E	EUCLIDES
E5	Euclides  quantity codes
E6	Euclides Lab method codes
E7	Euclides Lab equipment codes
ENZC	Enzyme Codes
FDDC	First DataBank Drug Codes
FDDX	First DataBank Diagnostic Codes
FDK	FDA K10
HB	HIBCC
HCPCS	CMS (formerly HCFA)  Common Procedure Coding System
HCPT	Health Care Provider Taxonomy
HHC	Home Health Care
HI	Health Outcomes
HL7nnnn	HL7 Defined Codes where nnnn is the HL7 table number
HOT	Japanese Nationwide Medicine Code
HPC	CMS (formerly HCFA )Procedure Codes (HCPCS)
I10	ICD-10
I10P	ICD-10  Procedure Codes
I9	ICD9
I9C	ICD-9CM
IBT	ISBT
IBTnnnn	ISBT 128 codes where nnnn  specifies a specific table within ISBT 128.
IC2	ICHPPC-2
ICD10AM	ICD-10 Australian modification
ICD10CA	ICD-10 Canada
ICDO	International Classification of Diseases for Oncology
ICS	ICCS
ICSD	International Classification of Sleep Disorders
ISOnnnn	ISO Defined Codes where nnnn is the ISO table number
ISO+	ISO 2955.83 (units of measure) with HL7 extensions
IUPP	IUPAC/IFCC Property Codes
IUPC	IUPAC/IFCC Component Codes
JC8	Japanese Chemistry
JC10	JLAC/JSLM, nationwide laboratory code
JJ1017	Japanese Image Examination Cache
LB	Local billing code
LN	Logical Observation Identifier Names and Codes (LOINC®)
MCD	Medicaid
MCR	Medicare
MDDX	Medispan Diagnostic Codes
MEDC	Medical Economics Drug Codes
MEDR	Medical Dictionary for Drug Regulatory Affairs (MEDDRA)
MEDX	Medical Economics Diagnostic Codes
MGPI	Medispan GPI
MVX	CDC Vaccine Manufacturer Codes
NDA	NANDA
NDC	National drug codes
NIC	Nursing Interventions Classification
NPI	National Provider Identifier
NUBC	National Uniform Billing Committee Code
OHA	Omaha System
OHA	Omaha
POS	POS Codes
RC	Read Classification
SDM	SNOMED- DICOM Microglossary
SNM	Systemized Nomenclature of Medicine (SNOMED)
SNM3	SNOMED International
SNT	SNOMED topology codes (anatomic sites)
UC	UCDS
UMD	MDNS
UML	Unified Medical Language
UPC	Universal Product Code
UPIN	UPIN
USPS	United States Postal Service
W1	WHO record # drug codes (6 digit)
W2	WHO record # drug codes (8 digit)
W4	WHO record # code with ASTM extension
WC	WHO ATC
         * */
    ];
    public static function validate(string $data): bool
    {
        //if table is empty no error will be raised
        if(key_exists($data, static::$table)){
            return true;
        }elseif(preg_match('/(99[A-Z]{3})/i', $data)){//99zzz (where z is an alphanumeric character)
            return true;
        }else{
            return false;
        }

    }
}