<?php

use Swaggest\JsonSchema\Schema;


   function saveData($formData, $path){
	    echo ("data: " . $formData);	
        //uploadGSFileBNS($path,$file,$formData);
    }
    function getFileInfo($file){       
        $file_array = getGSFile_fromId($file);    
	    //$file_array['parentDir'] = getPathDir($file_array['parentDir']);        
        echo (json_encode($file_array));
    }
    function getPathDir($dir, $basePath){
        //echo(getAttr_fromGSFileId($dir,'path'));
        $dir = getAttr_fromGSFileId($dir,'path');
        $basePath = basename($basePath);
        $data = array($dir,$basePath);
        echo(json_encode($data));
    }

    function uploadMetadataFile($file, $valid){
        // $dirTmp   = $GLOBALS['dataDir']."/".$_SESSION['User']['id']."/".$_SESSION['User']['activeProject']."/".$GLOBALS['tmpUser_dir'];
        // move_uploaded_file($file,$dirTmp);
    }
    function validFileUpload($data){


$schemaJson = <<<'JSON'
{
    "id": "https://raw.githubusercontent.com/Acivico/jsonSchema/main/basic_file.json",
	"$schema": "http://json-schema.org/draft-04/schema#",
	"title": "VRE",
	"description": "",
	"type": "object",
	"properties": {
		"_id": {
			"type": "string"
		},
		"expiration": {
			"type": "string",
			"format": "data-time",
			"options": {
				"hidden": true
			}
		},
		"mtime": {
			"type": "string",
			"format": "data-time",
			"options": {
				"hidden": true
			}
		},
		"owner": {
			"type": "string",
			"readOnly": true
		},
		"parentDir": {
			"type": "string"
		},
		"path": {
			"type": "string",
			"format": "path",
			"required": true
		},
		"project": {
			"type": "string"
		},
		"size": {
			"type": "integer",			
			"options": {
				"hidden": true
			}			
		},
		"type": {
			"type": "string",
			"enum": [
				"file",
				"dir"
			]
		},
		"compressed": {
			"type": "string",
			"enum": [
				"gzip",
				"zip"
			]
		},
		"data_type": {
			"type": "string",
			"enum": [
				"chromatin_3dmodel",
				"chromatin_3dmodel_ensemble",
				"chromatin_compartments",
				"chromatin_tads",
				"chromatin_traj",
				"configuration_file",
				"data_atac_seq",
				"data_chip_seq",
				"data_chic",
				"data_dna_methylation",
				"data_fish",
				"data_mnase_seq",
				"data_rna_seq",
				"data_wgbs",
				"docking_ranking",
				"hic_biases",
				"hic_contacts_coverage",
				"hic_contacts_differential",
				"hic_contacts_matrix",
				"hic_contacts_peaks",
				"hic_directionality",
				"hic_reads",
				"hic_sequences",
				"hic_tads_scale",
				"md_restart",
				"na_md_atom_traj_coords",
				"na_md_atom_traj_top",
				"na_md_cg_traj",
				"na_structure",
				"na_traj",
				"na_traj_coords",
				"na_traj_top",
				"nucleosome_dynamics",
				"nucleosome_free_regions",
				"nucleosome_gene_phasing",
				"nucleosome_positioning",
				"nucleosome_stiffness",
				"prot_dna_specificity",
				"prot_dna_structure",
				"prot_structure",
				"chic_matrix",
				"pchic_matrix",
				"pchic_scores",
				"pchAS",
				"sequence_annotation",
				"sequence_dna",
				"sequence_cdna",
				"sequence_genomic",
				"sequence_mapping_index_bowtie",
				"sequence_mapping_index_bwa",
				"sequence_mapping_index_gem",
				"sequence_mapping_index_kallisto",
				"sequence_prot",
				"sequence_rna",
				"structure",
				"tool_intermediate_file",
				"tool_statistics",
				"tss_classification_by_nucleosomes"
			],
			"options": {
				"enum_titles": [
					"Chromatin 3D Model",
					"Chromatin 3D Model Ensemble",
					"Chromatin Compartments",
					"Chromatin Tads",
					"Chromatin Traj",
					"Configuration File",
					"Data Atac Seq",
					"Data Chip Seq",
					"Data Chic",
					"Data DNA Methylation",
					"Data Fish",
					"Data Mnase Seq",
					"Data RNA Seq",
					"Data Wgbs",
					"Docking Ranking",
					"Hic Biases",
					"Hic Contacts Coverage",
					"Hic Contacts Differential",
					"Hic Contacts_matrix",
					"Hic Contacts_peaks",
					"Hic Directionality",
					"Hic Reads",
					"Hic Sequences",
					"Hic Tads_scale",
					"Md Restart",
					"Na Md Atom Traj Coords",
					"Na Md Atom Traj Top",
					"Na Md Cg Traj",
					"Na Structure",
					"Na Traj",
					"Na Traj Coords",
					"Na Traj Top",
					"Nucleosome Dynamics",
					"Nucleosome Free_regions",
					"Nucleosome Gene_phasing",
					"Nucleosome Positioning",
					"Nucleosome Stiffness",
					"Prot DNA Specificity",
					"Prot DNA Structure",
					"Prot Structure",
					"Chic Matrix",
					"Pchic Matrix",
					"Pchic Scores",
					"PchAS",
					"Sequence Annotation",
					"Sequence DNA",
					"Sequence CDNA",
					"Sequence Genomic",
					"Sequence Mapping Index Bowtie",
					"Sequence Mapping Index Bwa",
					"Sequence Mapping Index Gem",
					"Sequence Mapping Index Kallisto",
					"Sequence Prot",
					"Sequence RNA",
					"Structure",
					"Tool intermediate file",
					"Tool Statistics",
					"Classification nucleosomes"
				]
			}
		},
		"description": {
			"type": "string"
		},
		"format": {
			"type": "string",
			"enum": [
				"null",
				"AMB",
				"ANN",
				"BAI",
				"BAM",
				"BB",
				"BED",
				"BEDGRAPH",
				"BT2",
				"BW",
				"BWT",
				"CPT",
				"CSV",
				"DCD",
				"FASTA",
				"FASTQ",
				"GEM",
				"GFF",
				"GFF3",
				"GTF",
				"HDF5",
				"IDX",
				"JSON",
				"LIF",
				"MDCRD",
				"NETCDF",
				"PAC",
				"PARMTOP",
				"PDB",
				"PDF",
				"PICKLE",
				"PNG",
				"RDATA",
				"RST",
				"SA",
				"TAR",
				"TBI",
				"TIFF",
				"TOP",
				"TPR",
				"TSV",
				"TXT",
				"VCF",
				"WIG",
				"XTC"
			]
		},
		"input_files": {
			"type": "array",
			"uniqueItems": true
		},
		"repository": {
			"type": "string"
		},
		"source_url": {
			"type": "string",
			"format": "uri"
		},
		"sources": {
			"type": "array",
			"items": {
				"type": "integer"
			}
		},
		"validated": {
			"type": "string",
			"enum": [
				"TRUE",
				"FALSE"
			]
		},
		"visible": {
			"type": "boolean",
			"default": true
		},
		"cloudName": {
			"type": "string"
		}
	},
	"required": ["path"]
}
JSON;

$schema = Schema::import(json_decode($schemaJson));
$schema->in(json_decode(<<<'JSON'
{
    "_id":"ECSHUSER60af81d9452bc_60b7519dc813d3.27458541",
    "expiration":{"$date":{"$numberLong":"1638351564000"}},
    "mtime":{"$date":{"$numberLong":"1622626764000"}},
    "owner":"ECSHUSER60af81d9452bc",
    "parentDir":"ECSHUSER60af81d9452bc_60af81d9602339.00180596",
    "path":"ECSHUSER60af81d9452bc\/__PROJ60af81d9452c17.77939678\/uploads\/pruebas.txt",
    "project":"__PROJ60af81d9452c17.77939678",
    "size":30,
    "validated":1,
    "data_type":"structure",
    "description":"description",
    "format":"TXT",
    "input_files":[0],
    "taxon_id":0,
    "visible":true
}
JSON
));

#$schema = Schema::import('https://raw.githubusercontent.com/Acivico/jsonSchema/main/basic_file.json');
#$schema->in($json);
var_dump($schema);
exit(0);
     }
?>
