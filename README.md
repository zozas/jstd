# jstd
JavaScript Techical Debt estimator
https://jstd.ece.uowm.gr/

The dataset of the manuscript "Forecasting Technical Debt in JavaScript Applications" by Ioannis Zozas, Stamatia Bibi, Apostolos Ampatzoglou is in the ZIP file

Metrics included :

1. External Indicators

POPL -> Popularity – Number of stars in github
AGE -> Reverse days to the latest release
OPEN_ISSUES -> Open issues (bugs)
CLOSED_ISSUES -> Closed/resolved issues (bugs)
DEVLP -> Developers/contributors in the project
PART -> Commits for every release.
DOC -> Comments per commit.
UPD -> Frequency of updates (in days between releases)

2. Source Code Size & Complexity Metrics

	SLOC	Physical source code lines
	LCOM	Lines of comments.
	LOC	Total lines of code = SLOC + LCOM.
	NOA	The number of attributes.
	NOC	The number of classes.
	NOM	The number of methods.
	FILES	The number of files.
	DIRS	The number of directories.
	SIZE	Release size in bytes.
	PARM	Number of function parameters.
	DIT	Depth of inheritance tree.
	MEM	Memory heap.
	CC	Cyclomatic complexity.
	CCDEN	Cyclomatic complexity density.
	HEFF	Halstead effort.
	HPV	Halstead program volume.
	HPL	Halstead program level difficulty.
	CLONE	Duplicate (cloned) lines.
	COVRG	Source code coverage percent.
Maintainabil.	OBFS	Number of obfuscation incidents.
	CSMELL	Total count of code smell issues.
	VULN	Total count of vulnerability issues.
JS metrics	WITH	WITH keyword statements.
	EVAL	EVAL keyword statements.
	VECMA	Version of ECMAScript applied.
	NEW	NEW keyword statements.
	ANONYM	Number of Anonymous functions.
	ARROW	Number of Arrow functions.
TD 	TD	TD Principal calculated based 
on the benchmark of
Amanatidis et al. [2]

