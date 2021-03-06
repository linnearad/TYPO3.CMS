<?php
namespace TYPO3\CMS\Impexp\Tests\Functional\Import;

/*
 * This file is part of the TYPO3 CMS project.
 *
 * It is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public License, either version 2
 * of the License, or any later version.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * The TYPO3 project - inspiring people to share!
 */

use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Impexp\Import;
use TYPO3\CMS\Impexp\Tests\Functional\AbstractImportExportTestCase;

/**
 * Test case
 */
class PagesAndTtContentWithImagesInEmptyDatabaseTest extends AbstractImportExportTestCase
{
    /**
     * @test
     */
    public function importPagesAndRelatedTtContentWithImagesOnCaseSensitiveFilesystems()
    {
        $subject = GeneralUtility::makeInstance(Import::class);
        $subject->init();

        if (!$this->isCaseSensitiveFilesystem()) {
            $this->markTestSkipped('Test not available on case insensitive filesystems.');
        }

        $subject->loadFile(
            __DIR__ . '/../Fixtures/XmlImports/pages-and-ttcontent-with-image.xml',
            1
        );
        $subject->importData(0);

        $this->testFilesToDelete[] = PATH_site . 'fileadmin/user_upload/typo3_image2.jpg';

        $this->assertCSVDataSet('EXT:impexp/Tests/Functional/Fixtures/DatabaseAssertions/importPagesAndRelatedTtContentWithImagesOnCaseSensitiveFilesystems.csv');

        $this->assertFileEquals(__DIR__ . '/../Fixtures/Folders/fileadmin/user_upload/typo3_image2.jpg', PATH_site . 'fileadmin/user_upload/typo3_image2.jpg');
    }

    /**
     * @test
     */
    public function importPagesAndRelatedTtContentWithImagesOnCaseInsensitiveFilesystems()
    {
        $subject = GeneralUtility::makeInstance(Import::class);
        $subject->init();

        if ($this->isCaseSensitiveFilesystem()) {
            $this->markTestSkipped('Test not available on case sensitive filesystems.');
        }

        $subject->loadFile(
            __DIR__ . '/../Fixtures/XmlImports/pages-and-ttcontent-with-image.xml',
            1
        );
        $subject->importData(0);

        $this->testFilesToDelete[] = PATH_site . 'fileadmin/user_upload/typo3_image2.jpg';

        $this->assertCSVDataSet('EXT:impexp/Tests/Functional/Fixtures/DatabaseAssertions/importPagesAndRelatedTtContentWithImagesOnCaseInsensitiveFilesystems.csv');

        $this->assertFileEquals(__DIR__ . '/../Fixtures/Folders/fileadmin/user_upload/typo3_image2.jpg', PATH_site . 'fileadmin/user_upload/typo3_image2.jpg');
    }

    /**
     * @test
     */
    public function importPagesAndRelatedTtContentWithImagesButWithoutStorageOnCaseSensitiveFilesystems()
    {
        $subject = GeneralUtility::makeInstance(Import::class);
        $subject->init();

        if (!$this->isCaseSensitiveFilesystem()) {
            $this->markTestSkipped('Test not available on case insensitive filesystems.');
        }

        $subject->loadFile(
            __DIR__ . '/../Fixtures/XmlImports/pages-and-ttcontent-with-image-without-storage.xml',
            1
        );
        $subject->importData(0);

        $this->testFilesToDelete[] = PATH_site . 'fileadmin/user_upload/typo3_image2.jpg';

        $this->assertCSVDataSet('EXT:impexp/Tests/Functional/Fixtures/DatabaseAssertions/importPagesAndRelatedTtContentWithImagesButWithoutStorageOnCaseSensitiveFilesystems.csv');

        $this->assertFileEquals(__DIR__ . '/../Fixtures/Folders/fileadmin/user_upload/typo3_image2.jpg', PATH_site . 'fileadmin/user_upload/typo3_image2.jpg');
    }

    /**
     * @test
     */
    public function importPagesAndRelatedTtContentWithImagesButWithoutStorageOnCaseInsensitiveFilesystems()
    {
        $subject = GeneralUtility::makeInstance(Import::class);
        $subject->init();

        if ($this->isCaseSensitiveFilesystem()) {
            $this->markTestSkipped('Test not available on case sensitive filesystems.');
        }

        $subject->loadFile(
            __DIR__ . '/../Fixtures/XmlImports/pages-and-ttcontent-with-image-without-storage.xml',
            1
        );
        $subject->importData(0);

        $this->testFilesToDelete[] = PATH_site . 'fileadmin/user_upload/typo3_image2.jpg';

        $this->assertCSVDataSet('EXT:impexp/Tests/Functional/Fixtures/DatabaseAssertions/importPagesAndRelatedTtContentWithImagesButWithoutStorageOnCaseInsensitiveFilesystems.csv');

        $this->assertFileEquals(__DIR__ . '/../Fixtures/Folders/fileadmin/user_upload/typo3_image2.jpg', PATH_site . 'fileadmin/user_upload/typo3_image2.jpg');
    }

    /**
     * @test
     */
    public function importPagesAndRelatedTtContentWithImagesWithSpacesInPath()
    {
        $subject = GeneralUtility::makeInstance(Import::class);
        $subject->init();

        $subject->loadFile(
            __DIR__ . '/../Fixtures/XmlImports/pages-and-ttcontent-with-image-with-spaces-in-path.xml',
            1
        );
        $subject->importData(0);

        $this->testFilesToDelete[] = PATH_site . 'fileadmin/user_upload/folder_with_spaces/typo3_image2.jpg';
        $this->testFilesToDelete[] = PATH_site . 'fileadmin/user_upload/folder_with_spaces/typo3_image3.jpg';

        $this->assertCSVDataSet('EXT:impexp/Tests/Functional/Fixtures/DatabaseAssertions/importPagesAndRelatedTtContentWithImagesWithSpacesInPath.csv');

        $this->assertFileEquals(__DIR__ . '/../Fixtures/Folders/fileadmin/user_upload/typo3_image2.jpg', PATH_site . 'fileadmin/user_upload/folder_with_spaces/typo3_image2.jpg');
        $this->assertFileEquals(__DIR__ . '/../Fixtures/Folders/fileadmin/user_upload/typo3_image3.jpg', PATH_site . 'fileadmin/user_upload/folder_with_spaces/typo3_image3.jpg');
    }

    /**
     * @test
     */
    public function importPagesAndRelatedTtContentWithImagesButNotIncluded()
    {
        $subject = GeneralUtility::makeInstance(Import::class);
        $subject->init();

        $subject->loadFile(
            // Files are parallel to the fixture .xml file in a folder - impexp tests for /../ not allowed in path, so we set an absolute path here
            PATH_site . 'typo3/sysext/impexp/Tests/Functional/Fixtures/XmlImports/pages-and-ttcontent-with-image-but-not-included.xml',
            1
        );
        $subject->importData(0);

        $this->testFilesToDelete[] = PATH_site . 'fileadmin/user_upload/typo3_image2.jpg';

        $this->assertCSVDataSet('EXT:impexp/Tests/Functional/Fixtures/DatabaseAssertions/importPagesAndRelatedTtContentWithImagesButNotIncluded.csv');

        $this->assertFileEquals(__DIR__ . '/../Fixtures/Folders/fileadmin/user_upload/typo3_image2.jpg', PATH_site . 'fileadmin/user_upload/typo3_image2.jpg');
    }

    /**
     * @test
     * @group not-postgres
     * @group not-mssql
     */
    public function importPagesAndRelatedTtContentWithImageWithForcedUids()
    {
        // @todo: Fix impexp / test with postgres: Probably, force uid's is not possible with postgres or needs
        // @todo: to be adapted in somehow.

        $subject = GeneralUtility::makeInstance(Import::class);
        $subject->init();

        $subject->loadFile(
            __DIR__ . '/../Fixtures/XmlImports/pages-and-ttcontent-with-image-with-forced-uids.xml',
            1
        );
        $subject->force_all_UIDS = true;
        $subject->importData(0);

        $this->testFilesToDelete[] = PATH_site . 'fileadmin/user_upload/typo3_image2.jpg';

        $this->assertCSVDataSet('EXT:impexp/Tests/Functional/Fixtures/DatabaseAssertions/importPagesAndRelatedTtContentWithImageWithForcedUids.csv');

        $this->assertFileEquals(__DIR__ . '/../Fixtures/Folders/fileadmin/user_upload/typo3_image2.jpg', PATH_site . 'fileadmin/user_upload/typo3_image2.jpg');

        $expectedErrors = [
                'Forcing uids of sys_file records is not supported! They will be imported as new records!'
        ];
        $errors = $subject->errorLog;
        $this->assertSame($expectedErrors, $errors);
    }
}
