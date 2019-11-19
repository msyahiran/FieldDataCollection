<?php
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 *                                   ATTENTION!
 * If you see this message in your browser (Internet Explorer, Mozilla Firefox, Google Chrome, etc.)
 * this means that PHP is not properly installed on your web server. Please refer to the PHP manual
 * for more details: http://php.net/manual/install.php 
 *
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 */

    include_once dirname(__FILE__) . '/components/startup.php';
    include_once dirname(__FILE__) . '/components/application.php';
    include_once dirname(__FILE__) . '/' . 'authorization.php';


    include_once dirname(__FILE__) . '/' . 'database_engine/mysql_engine.php';
    include_once dirname(__FILE__) . '/' . 'components/page/page_includes.php';

    function GetConnectionOptions()
    {
        $result = GetGlobalConnectionOptions();
        $result['client_encoding'] = 'utf8';
        GetApplication()->GetUserAuthentication()->applyIdentityToConnectionOptions($result);
        return $result;
    }

    
    
    
    // OnBeforePageExecute event handler
    
    
    
    class greenseeker_analysisPage extends Page
    {
        protected function DoBeforeCreate()
        {
            $this->SetTitle('Greenseeker Analysis');
            $this->SetMenuLabel('Greenseeker Analysis');
            $this->SetHeader(GetPagesHeader());
            $this->SetFooter(GetPagesFooter());
    
            $this->dataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`greenseeker analysis`');
            $this->dataset->addFields(
                array(
                    new DateField('Date', true, true),
                    new IntegerField('R1 Sub Block 1', true, true),
                    new IntegerField('R1 Sub Block 2', true, true),
                    new IntegerField('R1 Sub Block 3', true, true),
                    new IntegerField('R1 Sub Block 4', true, true),
                    new IntegerField('R1 Sub Block 5', true, true),
                    new IntegerField('R2 Sub Block 1', true, true),
                    new IntegerField('R2 Sub Block 2', true, true),
                    new IntegerField('R2 Sub Block 3', true, true),
                    new IntegerField('R2 Sub Block 4', true, true),
                    new IntegerField('R2 Sub Block 5', true, true),
                    new IntegerField('R3 Sub Block 1', true, true),
                    new IntegerField('R3 Sub Block 2', true, true),
                    new IntegerField('R3 Sub Block 3', true, true),
                    new IntegerField('R3 Sub Block 4', true, true),
                    new IntegerField('R3 Sub Block 5', true, true),
                    new IntegerField('R4 Sub Block 1', true, true),
                    new IntegerField('R4 Sub Block 2', true, true),
                    new IntegerField('R4 Sub Block 3', true, true),
                    new IntegerField('R4 Sub Block 4', true, true),
                    new IntegerField('R4 Sub Block 5', true, true)
                )
            );
        }
    
        protected function DoPrepare() {
    
        }
    
        protected function CreatePageNavigator()
        {
            $result = new CompositePageNavigator($this);
            
            $partitionNavigator = new PageNavigator('pnav', $this, $this->dataset);
            $partitionNavigator->SetRowsPerPage(20);
            $result->AddPageNavigator($partitionNavigator);
            
            return $result;
        }
    
        protected function CreateRssGenerator()
        {
            return null;
        }
    
        protected function setupCharts()
        {
            $chart = new Chart('r1', Chart::TYPE_LINE, $this->dataset);
            $chart->setTitle('Average NDVI Value Sub Block 1');
            $chart->setDomainColumn('Date', 'Date', 'date');
            $chart->addDataColumn('R1 Sub Block 1', 'R1', 'float');
            $chart->addDataColumn('R2 Sub Block 1', 'R2', 'float');
            $chart->addDataColumn('R3 Sub Block 1', 'R3', 'float');
            $chart->addDataColumn('R4 Sub Block 1', 'R4', 'float');
            $this->addChart($chart, 0, ChartPosition::BEFORE_GRID, 5);$chart = new Chart('r2', Chart::TYPE_LINE, $this->dataset);
            $chart->setTitle('Average NDVI Value Sub Block 2');
            $chart->setDomainColumn('Date', 'Date', 'date');
            $chart->addDataColumn('R1 Sub Block 2', 'R1', 'float');
            $chart->addDataColumn('R2 Sub Block 2', 'R2', 'float');
            $chart->addDataColumn('R3 Sub Block 2', 'R3', 'float');
            $chart->addDataColumn('R4 Sub Block 2', 'R4', 'float');
            $this->addChart($chart, 1, ChartPosition::BEFORE_GRID, 5);$chart = new Chart('r3', Chart::TYPE_LINE, $this->dataset);
            $chart->setTitle('Average NDVI Value Sub Block 3');
            $chart->setDomainColumn('Date', 'Date', 'date');
            $chart->addDataColumn('R1 Sub Block 3', 'R1', 'float');
            $chart->addDataColumn('R2 Sub Block 3', 'R2', 'float');
            $chart->addDataColumn('R3 Sub Block 3', 'R3', 'float');
            $chart->addDataColumn('R4 Sub Block 3', 'R4', 'float');
            $this->addChart($chart, 2, ChartPosition::BEFORE_GRID, 5);$chart = new Chart('r4', Chart::TYPE_LINE, $this->dataset);
            $chart->setTitle('Average NDVI Value Sub Block 4');
            $chart->setDomainColumn('Date', 'Date', 'date');
            $chart->addDataColumn('R4 Sub Block 4', 'R4', 'float');
            $chart->addDataColumn('R2 Sub Block 4', 'R2', 'float');
            $chart->addDataColumn('R3 Sub Block 4', 'R3', 'float');
            $chart->addDataColumn('R1 Sub Block 4', 'R1', 'float');
            $this->addChart($chart, 3, ChartPosition::BEFORE_GRID, 5);$chart = new Chart('r5', Chart::TYPE_LINE, $this->dataset);
            $chart->setTitle('Average NDVI Value Sub Block 5');
            $chart->setDomainColumn('Date', 'Date', 'date');
            $chart->addDataColumn('R1 Sub Block 5', 'R1', 'float');
            $chart->addDataColumn('R2 Sub Block 5', 'R2', 'float');
            $chart->addDataColumn('R3 Sub Block 5', 'R3', 'float');
            $chart->addDataColumn('R4 Sub Block 5', 'R4', 'float');
            $this->addChart($chart, 4, ChartPosition::BEFORE_GRID, 5);
        }
    
        protected function getFiltersColumns()
        {
            return array(
                new FilterColumn($this->dataset, 'Date', 'Date', 'Date'),
                new FilterColumn($this->dataset, 'R1 Sub Block 1', 'R1 Sub Block 1', 'R1 Sub Block 1'),
                new FilterColumn($this->dataset, 'R1 Sub Block 2', 'R1 Sub Block 2', 'R1 Sub Block 2'),
                new FilterColumn($this->dataset, 'R1 Sub Block 3', 'R1 Sub Block 3', 'R1 Sub Block 3'),
                new FilterColumn($this->dataset, 'R1 Sub Block 4', 'R1 Sub Block 4', 'R1 Sub Block 4'),
                new FilterColumn($this->dataset, 'R1 Sub Block 5', 'R1 Sub Block 5', 'R1 Sub Block 5'),
                new FilterColumn($this->dataset, 'R2 Sub Block 1', 'R2 Sub Block 1', 'R2 Sub Block 1'),
                new FilterColumn($this->dataset, 'R2 Sub Block 2', 'R2 Sub Block 2', 'R2 Sub Block 2'),
                new FilterColumn($this->dataset, 'R2 Sub Block 3', 'R2 Sub Block 3', 'R2 Sub Block 3'),
                new FilterColumn($this->dataset, 'R2 Sub Block 4', 'R2 Sub Block 4', 'R2 Sub Block 4'),
                new FilterColumn($this->dataset, 'R2 Sub Block 5', 'R2 Sub Block 5', 'R2 Sub Block 5'),
                new FilterColumn($this->dataset, 'R3 Sub Block 1', 'R3 Sub Block 1', 'R3 Sub Block 1'),
                new FilterColumn($this->dataset, 'R3 Sub Block 2', 'R3 Sub Block 2', 'R3 Sub Block 2'),
                new FilterColumn($this->dataset, 'R3 Sub Block 3', 'R3 Sub Block 3', 'R3 Sub Block 3'),
                new FilterColumn($this->dataset, 'R3 Sub Block 4', 'R3 Sub Block 4', 'R3 Sub Block 4'),
                new FilterColumn($this->dataset, 'R3 Sub Block 5', 'R3 Sub Block 5', 'R3 Sub Block 5'),
                new FilterColumn($this->dataset, 'R4 Sub Block 1', 'R4 Sub Block 1', 'R4 Sub Block 1'),
                new FilterColumn($this->dataset, 'R4 Sub Block 2', 'R4 Sub Block 2', 'R4 Sub Block 2'),
                new FilterColumn($this->dataset, 'R4 Sub Block 3', 'R4 Sub Block 3', 'R4 Sub Block 3'),
                new FilterColumn($this->dataset, 'R4 Sub Block 4', 'R4 Sub Block 4', 'R4 Sub Block 4'),
                new FilterColumn($this->dataset, 'R4 Sub Block 5', 'R4 Sub Block 5', 'R4 Sub Block 5')
            );
        }
    
        protected function setupQuickFilter(QuickFilter $quickFilter, FixedKeysArray $columns)
        {
            $quickFilter
                ->addColumn($columns['Date'])
                ->addColumn($columns['R1 Sub Block 1'])
                ->addColumn($columns['R1 Sub Block 2'])
                ->addColumn($columns['R1 Sub Block 3'])
                ->addColumn($columns['R1 Sub Block 4'])
                ->addColumn($columns['R1 Sub Block 5'])
                ->addColumn($columns['R2 Sub Block 1'])
                ->addColumn($columns['R2 Sub Block 2'])
                ->addColumn($columns['R2 Sub Block 3'])
                ->addColumn($columns['R2 Sub Block 4'])
                ->addColumn($columns['R2 Sub Block 5'])
                ->addColumn($columns['R3 Sub Block 1'])
                ->addColumn($columns['R3 Sub Block 2'])
                ->addColumn($columns['R3 Sub Block 3'])
                ->addColumn($columns['R3 Sub Block 4'])
                ->addColumn($columns['R3 Sub Block 5'])
                ->addColumn($columns['R4 Sub Block 1'])
                ->addColumn($columns['R4 Sub Block 2'])
                ->addColumn($columns['R4 Sub Block 3'])
                ->addColumn($columns['R4 Sub Block 4'])
                ->addColumn($columns['R4 Sub Block 5']);
        }
    
        protected function setupColumnFilter(ColumnFilter $columnFilter)
        {
            $columnFilter
                ->setOptionsFor('Date');
        }
    
        protected function setupFilterBuilder(FilterBuilder $filterBuilder, FixedKeysArray $columns)
        {
            $main_editor = new DateTimeEdit('date_edit', false, 'Y-m-d');
            
            $filterBuilder->addColumn(
                $columns['Date'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::DATE_EQUALS => $main_editor,
                    FilterConditionOperator::DATE_DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::TODAY => null,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('r1_sub_block_1_edit');
            
            $filterBuilder->addColumn(
                $columns['R1 Sub Block 1'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('r1_sub_block_2_edit');
            
            $filterBuilder->addColumn(
                $columns['R1 Sub Block 2'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('r1_sub_block_3_edit');
            
            $filterBuilder->addColumn(
                $columns['R1 Sub Block 3'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('r1_sub_block_4_edit');
            
            $filterBuilder->addColumn(
                $columns['R1 Sub Block 4'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('r1_sub_block_5_edit');
            
            $filterBuilder->addColumn(
                $columns['R1 Sub Block 5'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('r2_sub_block_1_edit');
            
            $filterBuilder->addColumn(
                $columns['R2 Sub Block 1'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('r2_sub_block_2_edit');
            
            $filterBuilder->addColumn(
                $columns['R2 Sub Block 2'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('r2_sub_block_3_edit');
            
            $filterBuilder->addColumn(
                $columns['R2 Sub Block 3'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('r2_sub_block_4_edit');
            
            $filterBuilder->addColumn(
                $columns['R2 Sub Block 4'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('r2_sub_block_5_edit');
            
            $filterBuilder->addColumn(
                $columns['R2 Sub Block 5'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('r3_sub_block_1_edit');
            
            $filterBuilder->addColumn(
                $columns['R3 Sub Block 1'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('r3_sub_block_2_edit');
            
            $filterBuilder->addColumn(
                $columns['R3 Sub Block 2'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('r3_sub_block_3_edit');
            
            $filterBuilder->addColumn(
                $columns['R3 Sub Block 3'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('r3_sub_block_4_edit');
            
            $filterBuilder->addColumn(
                $columns['R3 Sub Block 4'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('r3_sub_block_5_edit');
            
            $filterBuilder->addColumn(
                $columns['R3 Sub Block 5'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('r4_sub_block_1_edit');
            
            $filterBuilder->addColumn(
                $columns['R4 Sub Block 1'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('r4_sub_block_2_edit');
            
            $filterBuilder->addColumn(
                $columns['R4 Sub Block 2'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('r4_sub_block_3_edit');
            
            $filterBuilder->addColumn(
                $columns['R4 Sub Block 3'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('r4_sub_block_4_edit');
            
            $filterBuilder->addColumn(
                $columns['R4 Sub Block 4'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('r4_sub_block_5_edit');
            
            $filterBuilder->addColumn(
                $columns['R4 Sub Block 5'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
        }
    
        protected function AddOperationsColumns(Grid $grid)
        {
    
        }
    
        protected function AddFieldColumns(Grid $grid, $withDetails = true)
        {
            //
            // View column for Date field
            //
            $column = new DateTimeViewColumn('Date', 'Date', 'Date', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('Y-m-d');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for R1 Sub Block 1 field
            //
            $column = new NumberViewColumn('R1 Sub Block 1', 'R1 Sub Block 1', 'R1 Sub Block 1', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(4);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for R1 Sub Block 2 field
            //
            $column = new NumberViewColumn('R1 Sub Block 2', 'R1 Sub Block 2', 'R1 Sub Block 2', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(4);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for R1 Sub Block 3 field
            //
            $column = new NumberViewColumn('R1 Sub Block 3', 'R1 Sub Block 3', 'R1 Sub Block 3', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(4);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for R1 Sub Block 4 field
            //
            $column = new NumberViewColumn('R1 Sub Block 4', 'R1 Sub Block 4', 'R1 Sub Block 4', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(4);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for R1 Sub Block 5 field
            //
            $column = new NumberViewColumn('R1 Sub Block 5', 'R1 Sub Block 5', 'R1 Sub Block 5', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(4);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for R2 Sub Block 1 field
            //
            $column = new NumberViewColumn('R2 Sub Block 1', 'R2 Sub Block 1', 'R2 Sub Block 1', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(4);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for R2 Sub Block 2 field
            //
            $column = new NumberViewColumn('R2 Sub Block 2', 'R2 Sub Block 2', 'R2 Sub Block 2', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(4);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for R2 Sub Block 3 field
            //
            $column = new NumberViewColumn('R2 Sub Block 3', 'R2 Sub Block 3', 'R2 Sub Block 3', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(4);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for R2 Sub Block 4 field
            //
            $column = new NumberViewColumn('R2 Sub Block 4', 'R2 Sub Block 4', 'R2 Sub Block 4', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(4);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for R2 Sub Block 5 field
            //
            $column = new NumberViewColumn('R2 Sub Block 5', 'R2 Sub Block 5', 'R2 Sub Block 5', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(4);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for R3 Sub Block 1 field
            //
            $column = new NumberViewColumn('R3 Sub Block 1', 'R3 Sub Block 1', 'R3 Sub Block 1', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(4);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for R3 Sub Block 2 field
            //
            $column = new NumberViewColumn('R3 Sub Block 2', 'R3 Sub Block 2', 'R3 Sub Block 2', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(4);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for R3 Sub Block 3 field
            //
            $column = new NumberViewColumn('R3 Sub Block 3', 'R3 Sub Block 3', 'R3 Sub Block 3', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(4);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for R3 Sub Block 4 field
            //
            $column = new NumberViewColumn('R3 Sub Block 4', 'R3 Sub Block 4', 'R3 Sub Block 4', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(4);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for R3 Sub Block 5 field
            //
            $column = new NumberViewColumn('R3 Sub Block 5', 'R3 Sub Block 5', 'R3 Sub Block 5', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(4);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for R4 Sub Block 1 field
            //
            $column = new NumberViewColumn('R4 Sub Block 1', 'R4 Sub Block 1', 'R4 Sub Block 1', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(4);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for R4 Sub Block 2 field
            //
            $column = new NumberViewColumn('R4 Sub Block 2', 'R4 Sub Block 2', 'R4 Sub Block 2', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(4);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for R4 Sub Block 3 field
            //
            $column = new NumberViewColumn('R4 Sub Block 3', 'R4 Sub Block 3', 'R4 Sub Block 3', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(4);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for R4 Sub Block 4 field
            //
            $column = new NumberViewColumn('R4 Sub Block 4', 'R4 Sub Block 4', 'R4 Sub Block 4', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(4);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for R4 Sub Block 5 field
            //
            $column = new NumberViewColumn('R4 Sub Block 5', 'R4 Sub Block 5', 'R4 Sub Block 5', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(4);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
        }
    
        protected function AddSingleRecordViewColumns(Grid $grid)
        {
            //
            // View column for Date field
            //
            $column = new DateTimeViewColumn('Date', 'Date', 'Date', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('Y-m-d');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for R1 Sub Block 1 field
            //
            $column = new NumberViewColumn('R1 Sub Block 1', 'R1 Sub Block 1', 'R1 Sub Block 1', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(4);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for R1 Sub Block 2 field
            //
            $column = new NumberViewColumn('R1 Sub Block 2', 'R1 Sub Block 2', 'R1 Sub Block 2', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(4);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for R1 Sub Block 3 field
            //
            $column = new NumberViewColumn('R1 Sub Block 3', 'R1 Sub Block 3', 'R1 Sub Block 3', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(4);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for R1 Sub Block 4 field
            //
            $column = new NumberViewColumn('R1 Sub Block 4', 'R1 Sub Block 4', 'R1 Sub Block 4', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(4);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for R1 Sub Block 5 field
            //
            $column = new NumberViewColumn('R1 Sub Block 5', 'R1 Sub Block 5', 'R1 Sub Block 5', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(4);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for R2 Sub Block 1 field
            //
            $column = new NumberViewColumn('R2 Sub Block 1', 'R2 Sub Block 1', 'R2 Sub Block 1', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(4);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for R2 Sub Block 2 field
            //
            $column = new NumberViewColumn('R2 Sub Block 2', 'R2 Sub Block 2', 'R2 Sub Block 2', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(4);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for R2 Sub Block 3 field
            //
            $column = new NumberViewColumn('R2 Sub Block 3', 'R2 Sub Block 3', 'R2 Sub Block 3', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(4);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for R2 Sub Block 4 field
            //
            $column = new NumberViewColumn('R2 Sub Block 4', 'R2 Sub Block 4', 'R2 Sub Block 4', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(4);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for R2 Sub Block 5 field
            //
            $column = new NumberViewColumn('R2 Sub Block 5', 'R2 Sub Block 5', 'R2 Sub Block 5', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(4);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for R3 Sub Block 1 field
            //
            $column = new NumberViewColumn('R3 Sub Block 1', 'R3 Sub Block 1', 'R3 Sub Block 1', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(4);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for R3 Sub Block 2 field
            //
            $column = new NumberViewColumn('R3 Sub Block 2', 'R3 Sub Block 2', 'R3 Sub Block 2', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(4);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for R3 Sub Block 3 field
            //
            $column = new NumberViewColumn('R3 Sub Block 3', 'R3 Sub Block 3', 'R3 Sub Block 3', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(4);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for R3 Sub Block 4 field
            //
            $column = new NumberViewColumn('R3 Sub Block 4', 'R3 Sub Block 4', 'R3 Sub Block 4', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(4);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for R3 Sub Block 5 field
            //
            $column = new NumberViewColumn('R3 Sub Block 5', 'R3 Sub Block 5', 'R3 Sub Block 5', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(4);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for R4 Sub Block 1 field
            //
            $column = new NumberViewColumn('R4 Sub Block 1', 'R4 Sub Block 1', 'R4 Sub Block 1', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(4);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for R4 Sub Block 2 field
            //
            $column = new NumberViewColumn('R4 Sub Block 2', 'R4 Sub Block 2', 'R4 Sub Block 2', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(4);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for R4 Sub Block 3 field
            //
            $column = new NumberViewColumn('R4 Sub Block 3', 'R4 Sub Block 3', 'R4 Sub Block 3', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(4);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for R4 Sub Block 4 field
            //
            $column = new NumberViewColumn('R4 Sub Block 4', 'R4 Sub Block 4', 'R4 Sub Block 4', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(4);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for R4 Sub Block 5 field
            //
            $column = new NumberViewColumn('R4 Sub Block 5', 'R4 Sub Block 5', 'R4 Sub Block 5', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(4);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddSingleRecordViewColumn($column);
        }
    
        protected function AddEditColumns(Grid $grid)
        {
            //
            // Edit column for Date field
            //
            $editor = new DateTimeEdit('date_edit', false, 'Y-m-d');
            $editColumn = new CustomEditColumn('Date', 'Date', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for R1 Sub Block 1 field
            //
            $editor = new TextEdit('r1_sub_block_1_edit');
            $editColumn = new CustomEditColumn('R1 Sub Block 1', 'R1 Sub Block 1', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for R1 Sub Block 2 field
            //
            $editor = new TextEdit('r1_sub_block_2_edit');
            $editColumn = new CustomEditColumn('R1 Sub Block 2', 'R1 Sub Block 2', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for R1 Sub Block 3 field
            //
            $editor = new TextEdit('r1_sub_block_3_edit');
            $editColumn = new CustomEditColumn('R1 Sub Block 3', 'R1 Sub Block 3', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for R1 Sub Block 4 field
            //
            $editor = new TextEdit('r1_sub_block_4_edit');
            $editColumn = new CustomEditColumn('R1 Sub Block 4', 'R1 Sub Block 4', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for R1 Sub Block 5 field
            //
            $editor = new TextEdit('r1_sub_block_5_edit');
            $editColumn = new CustomEditColumn('R1 Sub Block 5', 'R1 Sub Block 5', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for R2 Sub Block 1 field
            //
            $editor = new TextEdit('r2_sub_block_1_edit');
            $editColumn = new CustomEditColumn('R2 Sub Block 1', 'R2 Sub Block 1', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for R2 Sub Block 2 field
            //
            $editor = new TextEdit('r2_sub_block_2_edit');
            $editColumn = new CustomEditColumn('R2 Sub Block 2', 'R2 Sub Block 2', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for R2 Sub Block 3 field
            //
            $editor = new TextEdit('r2_sub_block_3_edit');
            $editColumn = new CustomEditColumn('R2 Sub Block 3', 'R2 Sub Block 3', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for R2 Sub Block 4 field
            //
            $editor = new TextEdit('r2_sub_block_4_edit');
            $editColumn = new CustomEditColumn('R2 Sub Block 4', 'R2 Sub Block 4', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for R2 Sub Block 5 field
            //
            $editor = new TextEdit('r2_sub_block_5_edit');
            $editColumn = new CustomEditColumn('R2 Sub Block 5', 'R2 Sub Block 5', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for R3 Sub Block 1 field
            //
            $editor = new TextEdit('r3_sub_block_1_edit');
            $editColumn = new CustomEditColumn('R3 Sub Block 1', 'R3 Sub Block 1', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for R3 Sub Block 2 field
            //
            $editor = new TextEdit('r3_sub_block_2_edit');
            $editColumn = new CustomEditColumn('R3 Sub Block 2', 'R3 Sub Block 2', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for R3 Sub Block 3 field
            //
            $editor = new TextEdit('r3_sub_block_3_edit');
            $editColumn = new CustomEditColumn('R3 Sub Block 3', 'R3 Sub Block 3', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for R3 Sub Block 4 field
            //
            $editor = new TextEdit('r3_sub_block_4_edit');
            $editColumn = new CustomEditColumn('R3 Sub Block 4', 'R3 Sub Block 4', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for R3 Sub Block 5 field
            //
            $editor = new TextEdit('r3_sub_block_5_edit');
            $editColumn = new CustomEditColumn('R3 Sub Block 5', 'R3 Sub Block 5', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for R4 Sub Block 1 field
            //
            $editor = new TextEdit('r4_sub_block_1_edit');
            $editColumn = new CustomEditColumn('R4 Sub Block 1', 'R4 Sub Block 1', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for R4 Sub Block 2 field
            //
            $editor = new TextEdit('r4_sub_block_2_edit');
            $editColumn = new CustomEditColumn('R4 Sub Block 2', 'R4 Sub Block 2', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for R4 Sub Block 3 field
            //
            $editor = new TextEdit('r4_sub_block_3_edit');
            $editColumn = new CustomEditColumn('R4 Sub Block 3', 'R4 Sub Block 3', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for R4 Sub Block 4 field
            //
            $editor = new TextEdit('r4_sub_block_4_edit');
            $editColumn = new CustomEditColumn('R4 Sub Block 4', 'R4 Sub Block 4', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for R4 Sub Block 5 field
            //
            $editor = new TextEdit('r4_sub_block_5_edit');
            $editColumn = new CustomEditColumn('R4 Sub Block 5', 'R4 Sub Block 5', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
        }
    
        protected function AddMultiEditColumns(Grid $grid)
        {
            //
            // Edit column for Date field
            //
            $editor = new DateTimeEdit('date_edit', false, 'Y-m-d');
            $editColumn = new CustomEditColumn('Date', 'Date', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for R1 Sub Block 1 field
            //
            $editor = new TextEdit('r1_sub_block_1_edit');
            $editColumn = new CustomEditColumn('R1 Sub Block 1', 'R1 Sub Block 1', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for R1 Sub Block 2 field
            //
            $editor = new TextEdit('r1_sub_block_2_edit');
            $editColumn = new CustomEditColumn('R1 Sub Block 2', 'R1 Sub Block 2', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for R1 Sub Block 3 field
            //
            $editor = new TextEdit('r1_sub_block_3_edit');
            $editColumn = new CustomEditColumn('R1 Sub Block 3', 'R1 Sub Block 3', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for R1 Sub Block 4 field
            //
            $editor = new TextEdit('r1_sub_block_4_edit');
            $editColumn = new CustomEditColumn('R1 Sub Block 4', 'R1 Sub Block 4', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for R1 Sub Block 5 field
            //
            $editor = new TextEdit('r1_sub_block_5_edit');
            $editColumn = new CustomEditColumn('R1 Sub Block 5', 'R1 Sub Block 5', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for R2 Sub Block 1 field
            //
            $editor = new TextEdit('r2_sub_block_1_edit');
            $editColumn = new CustomEditColumn('R2 Sub Block 1', 'R2 Sub Block 1', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for R2 Sub Block 2 field
            //
            $editor = new TextEdit('r2_sub_block_2_edit');
            $editColumn = new CustomEditColumn('R2 Sub Block 2', 'R2 Sub Block 2', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for R2 Sub Block 3 field
            //
            $editor = new TextEdit('r2_sub_block_3_edit');
            $editColumn = new CustomEditColumn('R2 Sub Block 3', 'R2 Sub Block 3', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for R2 Sub Block 4 field
            //
            $editor = new TextEdit('r2_sub_block_4_edit');
            $editColumn = new CustomEditColumn('R2 Sub Block 4', 'R2 Sub Block 4', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for R2 Sub Block 5 field
            //
            $editor = new TextEdit('r2_sub_block_5_edit');
            $editColumn = new CustomEditColumn('R2 Sub Block 5', 'R2 Sub Block 5', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for R3 Sub Block 1 field
            //
            $editor = new TextEdit('r3_sub_block_1_edit');
            $editColumn = new CustomEditColumn('R3 Sub Block 1', 'R3 Sub Block 1', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for R3 Sub Block 2 field
            //
            $editor = new TextEdit('r3_sub_block_2_edit');
            $editColumn = new CustomEditColumn('R3 Sub Block 2', 'R3 Sub Block 2', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for R3 Sub Block 3 field
            //
            $editor = new TextEdit('r3_sub_block_3_edit');
            $editColumn = new CustomEditColumn('R3 Sub Block 3', 'R3 Sub Block 3', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for R3 Sub Block 4 field
            //
            $editor = new TextEdit('r3_sub_block_4_edit');
            $editColumn = new CustomEditColumn('R3 Sub Block 4', 'R3 Sub Block 4', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for R3 Sub Block 5 field
            //
            $editor = new TextEdit('r3_sub_block_5_edit');
            $editColumn = new CustomEditColumn('R3 Sub Block 5', 'R3 Sub Block 5', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for R4 Sub Block 1 field
            //
            $editor = new TextEdit('r4_sub_block_1_edit');
            $editColumn = new CustomEditColumn('R4 Sub Block 1', 'R4 Sub Block 1', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for R4 Sub Block 2 field
            //
            $editor = new TextEdit('r4_sub_block_2_edit');
            $editColumn = new CustomEditColumn('R4 Sub Block 2', 'R4 Sub Block 2', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for R4 Sub Block 3 field
            //
            $editor = new TextEdit('r4_sub_block_3_edit');
            $editColumn = new CustomEditColumn('R4 Sub Block 3', 'R4 Sub Block 3', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for R4 Sub Block 4 field
            //
            $editor = new TextEdit('r4_sub_block_4_edit');
            $editColumn = new CustomEditColumn('R4 Sub Block 4', 'R4 Sub Block 4', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for R4 Sub Block 5 field
            //
            $editor = new TextEdit('r4_sub_block_5_edit');
            $editColumn = new CustomEditColumn('R4 Sub Block 5', 'R4 Sub Block 5', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
        }
    
        protected function AddInsertColumns(Grid $grid)
        {
            //
            // Edit column for Date field
            //
            $editor = new DateTimeEdit('date_edit', false, 'Y-m-d');
            $editColumn = new CustomEditColumn('Date', 'Date', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for R1 Sub Block 1 field
            //
            $editor = new TextEdit('r1_sub_block_1_edit');
            $editColumn = new CustomEditColumn('R1 Sub Block 1', 'R1 Sub Block 1', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for R1 Sub Block 2 field
            //
            $editor = new TextEdit('r1_sub_block_2_edit');
            $editColumn = new CustomEditColumn('R1 Sub Block 2', 'R1 Sub Block 2', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for R1 Sub Block 3 field
            //
            $editor = new TextEdit('r1_sub_block_3_edit');
            $editColumn = new CustomEditColumn('R1 Sub Block 3', 'R1 Sub Block 3', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for R1 Sub Block 4 field
            //
            $editor = new TextEdit('r1_sub_block_4_edit');
            $editColumn = new CustomEditColumn('R1 Sub Block 4', 'R1 Sub Block 4', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for R1 Sub Block 5 field
            //
            $editor = new TextEdit('r1_sub_block_5_edit');
            $editColumn = new CustomEditColumn('R1 Sub Block 5', 'R1 Sub Block 5', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for R2 Sub Block 1 field
            //
            $editor = new TextEdit('r2_sub_block_1_edit');
            $editColumn = new CustomEditColumn('R2 Sub Block 1', 'R2 Sub Block 1', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for R2 Sub Block 2 field
            //
            $editor = new TextEdit('r2_sub_block_2_edit');
            $editColumn = new CustomEditColumn('R2 Sub Block 2', 'R2 Sub Block 2', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for R2 Sub Block 3 field
            //
            $editor = new TextEdit('r2_sub_block_3_edit');
            $editColumn = new CustomEditColumn('R2 Sub Block 3', 'R2 Sub Block 3', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for R2 Sub Block 4 field
            //
            $editor = new TextEdit('r2_sub_block_4_edit');
            $editColumn = new CustomEditColumn('R2 Sub Block 4', 'R2 Sub Block 4', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for R2 Sub Block 5 field
            //
            $editor = new TextEdit('r2_sub_block_5_edit');
            $editColumn = new CustomEditColumn('R2 Sub Block 5', 'R2 Sub Block 5', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for R3 Sub Block 1 field
            //
            $editor = new TextEdit('r3_sub_block_1_edit');
            $editColumn = new CustomEditColumn('R3 Sub Block 1', 'R3 Sub Block 1', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for R3 Sub Block 2 field
            //
            $editor = new TextEdit('r3_sub_block_2_edit');
            $editColumn = new CustomEditColumn('R3 Sub Block 2', 'R3 Sub Block 2', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for R3 Sub Block 3 field
            //
            $editor = new TextEdit('r3_sub_block_3_edit');
            $editColumn = new CustomEditColumn('R3 Sub Block 3', 'R3 Sub Block 3', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for R3 Sub Block 4 field
            //
            $editor = new TextEdit('r3_sub_block_4_edit');
            $editColumn = new CustomEditColumn('R3 Sub Block 4', 'R3 Sub Block 4', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for R3 Sub Block 5 field
            //
            $editor = new TextEdit('r3_sub_block_5_edit');
            $editColumn = new CustomEditColumn('R3 Sub Block 5', 'R3 Sub Block 5', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for R4 Sub Block 1 field
            //
            $editor = new TextEdit('r4_sub_block_1_edit');
            $editColumn = new CustomEditColumn('R4 Sub Block 1', 'R4 Sub Block 1', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for R4 Sub Block 2 field
            //
            $editor = new TextEdit('r4_sub_block_2_edit');
            $editColumn = new CustomEditColumn('R4 Sub Block 2', 'R4 Sub Block 2', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for R4 Sub Block 3 field
            //
            $editor = new TextEdit('r4_sub_block_3_edit');
            $editColumn = new CustomEditColumn('R4 Sub Block 3', 'R4 Sub Block 3', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for R4 Sub Block 4 field
            //
            $editor = new TextEdit('r4_sub_block_4_edit');
            $editColumn = new CustomEditColumn('R4 Sub Block 4', 'R4 Sub Block 4', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for R4 Sub Block 5 field
            //
            $editor = new TextEdit('r4_sub_block_5_edit');
            $editColumn = new CustomEditColumn('R4 Sub Block 5', 'R4 Sub Block 5', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            $grid->SetShowAddButton(false && $this->GetSecurityInfo()->HasAddGrant());
        }
    
        private function AddMultiUploadColumn(Grid $grid)
        {
    
        }
    
        protected function AddPrintColumns(Grid $grid)
        {
            //
            // View column for Date field
            //
            $column = new DateTimeViewColumn('Date', 'Date', 'Date', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('Y-m-d');
            $grid->AddPrintColumn($column);
            
            //
            // View column for R1 Sub Block 1 field
            //
            $column = new NumberViewColumn('R1 Sub Block 1', 'R1 Sub Block 1', 'R1 Sub Block 1', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(4);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddPrintColumn($column);
            
            //
            // View column for R1 Sub Block 2 field
            //
            $column = new NumberViewColumn('R1 Sub Block 2', 'R1 Sub Block 2', 'R1 Sub Block 2', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(4);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddPrintColumn($column);
            
            //
            // View column for R1 Sub Block 3 field
            //
            $column = new NumberViewColumn('R1 Sub Block 3', 'R1 Sub Block 3', 'R1 Sub Block 3', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(4);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddPrintColumn($column);
            
            //
            // View column for R1 Sub Block 4 field
            //
            $column = new NumberViewColumn('R1 Sub Block 4', 'R1 Sub Block 4', 'R1 Sub Block 4', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(4);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddPrintColumn($column);
            
            //
            // View column for R1 Sub Block 5 field
            //
            $column = new NumberViewColumn('R1 Sub Block 5', 'R1 Sub Block 5', 'R1 Sub Block 5', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(4);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddPrintColumn($column);
            
            //
            // View column for R2 Sub Block 1 field
            //
            $column = new NumberViewColumn('R2 Sub Block 1', 'R2 Sub Block 1', 'R2 Sub Block 1', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(4);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddPrintColumn($column);
            
            //
            // View column for R2 Sub Block 2 field
            //
            $column = new NumberViewColumn('R2 Sub Block 2', 'R2 Sub Block 2', 'R2 Sub Block 2', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(4);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddPrintColumn($column);
            
            //
            // View column for R2 Sub Block 3 field
            //
            $column = new NumberViewColumn('R2 Sub Block 3', 'R2 Sub Block 3', 'R2 Sub Block 3', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(4);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddPrintColumn($column);
            
            //
            // View column for R2 Sub Block 4 field
            //
            $column = new NumberViewColumn('R2 Sub Block 4', 'R2 Sub Block 4', 'R2 Sub Block 4', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(4);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddPrintColumn($column);
            
            //
            // View column for R2 Sub Block 5 field
            //
            $column = new NumberViewColumn('R2 Sub Block 5', 'R2 Sub Block 5', 'R2 Sub Block 5', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(4);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddPrintColumn($column);
            
            //
            // View column for R3 Sub Block 1 field
            //
            $column = new NumberViewColumn('R3 Sub Block 1', 'R3 Sub Block 1', 'R3 Sub Block 1', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(4);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddPrintColumn($column);
            
            //
            // View column for R3 Sub Block 2 field
            //
            $column = new NumberViewColumn('R3 Sub Block 2', 'R3 Sub Block 2', 'R3 Sub Block 2', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(4);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddPrintColumn($column);
            
            //
            // View column for R3 Sub Block 3 field
            //
            $column = new NumberViewColumn('R3 Sub Block 3', 'R3 Sub Block 3', 'R3 Sub Block 3', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(4);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddPrintColumn($column);
            
            //
            // View column for R3 Sub Block 4 field
            //
            $column = new NumberViewColumn('R3 Sub Block 4', 'R3 Sub Block 4', 'R3 Sub Block 4', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(4);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddPrintColumn($column);
            
            //
            // View column for R3 Sub Block 5 field
            //
            $column = new NumberViewColumn('R3 Sub Block 5', 'R3 Sub Block 5', 'R3 Sub Block 5', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(4);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddPrintColumn($column);
            
            //
            // View column for R4 Sub Block 1 field
            //
            $column = new NumberViewColumn('R4 Sub Block 1', 'R4 Sub Block 1', 'R4 Sub Block 1', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(4);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddPrintColumn($column);
            
            //
            // View column for R4 Sub Block 2 field
            //
            $column = new NumberViewColumn('R4 Sub Block 2', 'R4 Sub Block 2', 'R4 Sub Block 2', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(4);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddPrintColumn($column);
            
            //
            // View column for R4 Sub Block 3 field
            //
            $column = new NumberViewColumn('R4 Sub Block 3', 'R4 Sub Block 3', 'R4 Sub Block 3', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(4);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddPrintColumn($column);
            
            //
            // View column for R4 Sub Block 4 field
            //
            $column = new NumberViewColumn('R4 Sub Block 4', 'R4 Sub Block 4', 'R4 Sub Block 4', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(4);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddPrintColumn($column);
            
            //
            // View column for R4 Sub Block 5 field
            //
            $column = new NumberViewColumn('R4 Sub Block 5', 'R4 Sub Block 5', 'R4 Sub Block 5', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(4);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddPrintColumn($column);
        }
    
        protected function AddExportColumns(Grid $grid)
        {
            //
            // View column for Date field
            //
            $column = new DateTimeViewColumn('Date', 'Date', 'Date', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('Y-m-d');
            $grid->AddExportColumn($column);
            
            //
            // View column for R1 Sub Block 1 field
            //
            $column = new NumberViewColumn('R1 Sub Block 1', 'R1 Sub Block 1', 'R1 Sub Block 1', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(4);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddExportColumn($column);
            
            //
            // View column for R1 Sub Block 2 field
            //
            $column = new NumberViewColumn('R1 Sub Block 2', 'R1 Sub Block 2', 'R1 Sub Block 2', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(4);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddExportColumn($column);
            
            //
            // View column for R1 Sub Block 3 field
            //
            $column = new NumberViewColumn('R1 Sub Block 3', 'R1 Sub Block 3', 'R1 Sub Block 3', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(4);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddExportColumn($column);
            
            //
            // View column for R1 Sub Block 4 field
            //
            $column = new NumberViewColumn('R1 Sub Block 4', 'R1 Sub Block 4', 'R1 Sub Block 4', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(4);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddExportColumn($column);
            
            //
            // View column for R1 Sub Block 5 field
            //
            $column = new NumberViewColumn('R1 Sub Block 5', 'R1 Sub Block 5', 'R1 Sub Block 5', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(4);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddExportColumn($column);
            
            //
            // View column for R2 Sub Block 1 field
            //
            $column = new NumberViewColumn('R2 Sub Block 1', 'R2 Sub Block 1', 'R2 Sub Block 1', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(4);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddExportColumn($column);
            
            //
            // View column for R2 Sub Block 2 field
            //
            $column = new NumberViewColumn('R2 Sub Block 2', 'R2 Sub Block 2', 'R2 Sub Block 2', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(4);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddExportColumn($column);
            
            //
            // View column for R2 Sub Block 3 field
            //
            $column = new NumberViewColumn('R2 Sub Block 3', 'R2 Sub Block 3', 'R2 Sub Block 3', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(4);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddExportColumn($column);
            
            //
            // View column for R2 Sub Block 4 field
            //
            $column = new NumberViewColumn('R2 Sub Block 4', 'R2 Sub Block 4', 'R2 Sub Block 4', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(4);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddExportColumn($column);
            
            //
            // View column for R2 Sub Block 5 field
            //
            $column = new NumberViewColumn('R2 Sub Block 5', 'R2 Sub Block 5', 'R2 Sub Block 5', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(4);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddExportColumn($column);
            
            //
            // View column for R3 Sub Block 1 field
            //
            $column = new NumberViewColumn('R3 Sub Block 1', 'R3 Sub Block 1', 'R3 Sub Block 1', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(4);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddExportColumn($column);
            
            //
            // View column for R3 Sub Block 2 field
            //
            $column = new NumberViewColumn('R3 Sub Block 2', 'R3 Sub Block 2', 'R3 Sub Block 2', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(4);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddExportColumn($column);
            
            //
            // View column for R3 Sub Block 3 field
            //
            $column = new NumberViewColumn('R3 Sub Block 3', 'R3 Sub Block 3', 'R3 Sub Block 3', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(4);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddExportColumn($column);
            
            //
            // View column for R3 Sub Block 4 field
            //
            $column = new NumberViewColumn('R3 Sub Block 4', 'R3 Sub Block 4', 'R3 Sub Block 4', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(4);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddExportColumn($column);
            
            //
            // View column for R3 Sub Block 5 field
            //
            $column = new NumberViewColumn('R3 Sub Block 5', 'R3 Sub Block 5', 'R3 Sub Block 5', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(4);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddExportColumn($column);
            
            //
            // View column for R4 Sub Block 1 field
            //
            $column = new NumberViewColumn('R4 Sub Block 1', 'R4 Sub Block 1', 'R4 Sub Block 1', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(4);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddExportColumn($column);
            
            //
            // View column for R4 Sub Block 2 field
            //
            $column = new NumberViewColumn('R4 Sub Block 2', 'R4 Sub Block 2', 'R4 Sub Block 2', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(4);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddExportColumn($column);
            
            //
            // View column for R4 Sub Block 3 field
            //
            $column = new NumberViewColumn('R4 Sub Block 3', 'R4 Sub Block 3', 'R4 Sub Block 3', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(4);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddExportColumn($column);
            
            //
            // View column for R4 Sub Block 4 field
            //
            $column = new NumberViewColumn('R4 Sub Block 4', 'R4 Sub Block 4', 'R4 Sub Block 4', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(4);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddExportColumn($column);
            
            //
            // View column for R4 Sub Block 5 field
            //
            $column = new NumberViewColumn('R4 Sub Block 5', 'R4 Sub Block 5', 'R4 Sub Block 5', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(4);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddExportColumn($column);
        }
    
        private function AddCompareColumns(Grid $grid)
        {
            //
            // View column for Date field
            //
            $column = new DateTimeViewColumn('Date', 'Date', 'Date', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('Y-m-d');
            $grid->AddCompareColumn($column);
            
            //
            // View column for R1 Sub Block 1 field
            //
            $column = new NumberViewColumn('R1 Sub Block 1', 'R1 Sub Block 1', 'R1 Sub Block 1', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(4);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddCompareColumn($column);
            
            //
            // View column for R1 Sub Block 2 field
            //
            $column = new NumberViewColumn('R1 Sub Block 2', 'R1 Sub Block 2', 'R1 Sub Block 2', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(4);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddCompareColumn($column);
            
            //
            // View column for R1 Sub Block 3 field
            //
            $column = new NumberViewColumn('R1 Sub Block 3', 'R1 Sub Block 3', 'R1 Sub Block 3', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(4);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddCompareColumn($column);
            
            //
            // View column for R1 Sub Block 4 field
            //
            $column = new NumberViewColumn('R1 Sub Block 4', 'R1 Sub Block 4', 'R1 Sub Block 4', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(4);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddCompareColumn($column);
            
            //
            // View column for R1 Sub Block 5 field
            //
            $column = new NumberViewColumn('R1 Sub Block 5', 'R1 Sub Block 5', 'R1 Sub Block 5', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(4);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddCompareColumn($column);
            
            //
            // View column for R2 Sub Block 1 field
            //
            $column = new NumberViewColumn('R2 Sub Block 1', 'R2 Sub Block 1', 'R2 Sub Block 1', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(4);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddCompareColumn($column);
            
            //
            // View column for R2 Sub Block 2 field
            //
            $column = new NumberViewColumn('R2 Sub Block 2', 'R2 Sub Block 2', 'R2 Sub Block 2', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(4);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddCompareColumn($column);
            
            //
            // View column for R2 Sub Block 3 field
            //
            $column = new NumberViewColumn('R2 Sub Block 3', 'R2 Sub Block 3', 'R2 Sub Block 3', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(4);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddCompareColumn($column);
            
            //
            // View column for R2 Sub Block 4 field
            //
            $column = new NumberViewColumn('R2 Sub Block 4', 'R2 Sub Block 4', 'R2 Sub Block 4', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(4);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddCompareColumn($column);
            
            //
            // View column for R2 Sub Block 5 field
            //
            $column = new NumberViewColumn('R2 Sub Block 5', 'R2 Sub Block 5', 'R2 Sub Block 5', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(4);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddCompareColumn($column);
            
            //
            // View column for R3 Sub Block 1 field
            //
            $column = new NumberViewColumn('R3 Sub Block 1', 'R3 Sub Block 1', 'R3 Sub Block 1', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(4);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddCompareColumn($column);
            
            //
            // View column for R3 Sub Block 2 field
            //
            $column = new NumberViewColumn('R3 Sub Block 2', 'R3 Sub Block 2', 'R3 Sub Block 2', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(4);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddCompareColumn($column);
            
            //
            // View column for R3 Sub Block 3 field
            //
            $column = new NumberViewColumn('R3 Sub Block 3', 'R3 Sub Block 3', 'R3 Sub Block 3', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(4);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddCompareColumn($column);
            
            //
            // View column for R3 Sub Block 4 field
            //
            $column = new NumberViewColumn('R3 Sub Block 4', 'R3 Sub Block 4', 'R3 Sub Block 4', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(4);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddCompareColumn($column);
            
            //
            // View column for R3 Sub Block 5 field
            //
            $column = new NumberViewColumn('R3 Sub Block 5', 'R3 Sub Block 5', 'R3 Sub Block 5', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(4);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddCompareColumn($column);
            
            //
            // View column for R4 Sub Block 1 field
            //
            $column = new NumberViewColumn('R4 Sub Block 1', 'R4 Sub Block 1', 'R4 Sub Block 1', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(4);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddCompareColumn($column);
            
            //
            // View column for R4 Sub Block 2 field
            //
            $column = new NumberViewColumn('R4 Sub Block 2', 'R4 Sub Block 2', 'R4 Sub Block 2', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(4);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddCompareColumn($column);
            
            //
            // View column for R4 Sub Block 3 field
            //
            $column = new NumberViewColumn('R4 Sub Block 3', 'R4 Sub Block 3', 'R4 Sub Block 3', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(4);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddCompareColumn($column);
            
            //
            // View column for R4 Sub Block 4 field
            //
            $column = new NumberViewColumn('R4 Sub Block 4', 'R4 Sub Block 4', 'R4 Sub Block 4', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(4);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddCompareColumn($column);
            
            //
            // View column for R4 Sub Block 5 field
            //
            $column = new NumberViewColumn('R4 Sub Block 5', 'R4 Sub Block 5', 'R4 Sub Block 5', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(4);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddCompareColumn($column);
        }
    
        private function AddCompareHeaderColumns(Grid $grid)
        {
    
        }
    
        public function GetPageDirection()
        {
            return null;
        }
    
        public function isFilterConditionRequired()
        {
            return false;
        }
    
        protected function ApplyCommonColumnEditProperties(CustomEditColumn $column)
        {
            $column->SetDisplaySetToNullCheckBox(false);
            $column->SetDisplaySetToDefaultCheckBox(false);
    		$column->SetVariableContainer($this->GetColumnVariableContainer());
        }
    
        function GetCustomClientScript()
        {
            return ;
        }
        
        function GetOnPageLoadedClientScript()
        {
            return ;
        }
    
        protected function CreateGrid()
        {
            $result = new Grid($this, $this->dataset);
            if ($this->GetSecurityInfo()->HasDeleteGrant())
               $result->SetAllowDeleteSelected(false);
            else
               $result->SetAllowDeleteSelected(false);   
            
            ApplyCommonPageSettings($this, $result);
            
            $result->SetUseImagesForActions(true);
            $result->SetUseFixedHeader(false);
            $result->SetShowLineNumbers(false);
            $result->SetShowKeyColumnsImagesInHeader(false);
            $result->SetViewMode(ViewMode::TABLE);
            $result->setEnableRuntimeCustomization(true);
            $result->setAllowCompare(true);
            $this->AddCompareHeaderColumns($result);
            $this->AddCompareColumns($result);
            $result->setMultiEditAllowed($this->GetSecurityInfo()->HasEditGrant() && false);
            $result->setTableBordered(false);
            $result->setTableCondensed(false);
            
            $result->SetHighlightRowAtHover(false);
            $result->SetWidth('');
            $this->AddOperationsColumns($result);
            $this->AddFieldColumns($result);
            $this->AddSingleRecordViewColumns($result);
            $this->AddEditColumns($result);
            $this->AddMultiEditColumns($result);
            $this->AddInsertColumns($result);
            $this->AddPrintColumns($result);
            $this->AddExportColumns($result);
            $this->AddMultiUploadColumn($result);
    
    
            $this->SetShowPageList(true);
            $this->SetShowTopPageNavigator(true);
            $this->SetShowBottomPageNavigator(true);
            $this->setPrintListAvailable(true);
            $this->setPrintListRecordAvailable(false);
            $this->setPrintOneRecordAvailable(true);
            $this->setAllowPrintSelectedRecords(true);
            $this->setExportListAvailable(array('pdf', 'excel', 'word', 'xml', 'csv'));
            $this->setExportSelectedRecordsAvailable(array('pdf', 'excel', 'word', 'xml', 'csv'));
            $this->setExportListRecordAvailable(array());
            $this->setExportOneRecordAvailable(array('pdf', 'excel', 'word', 'xml', 'csv'));
    
            return $result;
        }
     
        protected function setClientSideEvents(Grid $grid) {
    
        }
    
        protected function doRegisterHandlers() {
            
            
        }
       
        protected function doCustomRenderColumn($fieldName, $fieldData, $rowData, &$customText, &$handled)
        { 
    
        }
    
        protected function doCustomRenderPrintColumn($fieldName, $fieldData, $rowData, &$customText, &$handled)
        { 
    
        }
    
        protected function doCustomRenderExportColumn($exportType, $fieldName, $fieldData, $rowData, &$customText, &$handled)
        { 
    
        }
    
        protected function doCustomDrawRow($rowData, &$cellFontColor, &$cellFontSize, &$cellBgColor, &$cellItalicAttr, &$cellBoldAttr)
        {
    
        }
    
        protected function doExtendedCustomDrawRow($rowData, &$rowCellStyles, &$rowStyles, &$rowClasses, &$cellClasses)
        {
    
        }
    
        protected function doCustomRenderTotal($totalValue, $aggregate, $columnName, &$customText, &$handled)
        {
    
        }
    
        protected function doCustomDefaultValues(&$values, &$handled) 
        {
    
        }
    
        protected function doCustomCompareColumn($columnName, $valueA, $valueB, &$result)
        {
    
        }
    
        protected function doBeforeInsertRecord($page, &$rowData, $tableName, &$cancel, &$message, &$messageDisplayTime)
        {
    
        }
    
        protected function doBeforeUpdateRecord($page, $oldRowData, &$rowData, $tableName, &$cancel, &$message, &$messageDisplayTime)
        {
    
        }
    
        protected function doBeforeDeleteRecord($page, &$rowData, $tableName, &$cancel, &$message, &$messageDisplayTime)
        {
    
        }
    
        protected function doAfterInsertRecord($page, $rowData, $tableName, &$success, &$message, &$messageDisplayTime)
        {
    
        }
    
        protected function doAfterUpdateRecord($page, $oldRowData, $rowData, $tableName, &$success, &$message, &$messageDisplayTime)
        {
    
        }
    
        protected function doAfterDeleteRecord($page, $rowData, $tableName, &$success, &$message, &$messageDisplayTime)
        {
    
        }
    
        protected function doCustomHTMLHeader($page, &$customHtmlHeaderText)
        { 
    
        }
    
        protected function doGetCustomTemplate($type, $part, $mode, &$result, &$params)
        {
    
        }
    
        protected function doGetCustomExportOptions(Page $page, $exportType, $rowData, &$options)
        {
    
        }
    
        protected function doFileUpload($fieldName, $rowData, &$result, &$accept, $originalFileName, $originalFileExtension, $fileSize, $tempFileName)
        {
    
        }
    
        protected function doPrepareChart(Chart $chart)
        {
    
        }
    
        protected function doPrepareColumnFilter(ColumnFilter $columnFilter)
        {
    
        }
    
        protected function doPrepareFilterBuilder(FilterBuilder $filterBuilder, FixedKeysArray $columns)
        {
    
        }
    
        protected function doGetSelectionFilters(FixedKeysArray $columns, &$result)
        {
    
        }
    
        protected function doGetCustomFormLayout($mode, FixedKeysArray $columns, FormLayout $layout)
        {
    
        }
    
        protected function doGetCustomColumnGroup(FixedKeysArray $columns, ViewColumnGroup $columnGroup)
        {
    
        }
    
        protected function doPageLoaded()
        {
    
        }
    
        protected function doCalculateFields($rowData, $fieldName, &$value)
        {
    
        }
    
        protected function doGetCustomPagePermissions(Page $page, PermissionSet &$permissions, &$handled)
        {
    
        }
    
        protected function doGetCustomRecordPermissions(Page $page, &$usingCondition, $rowData, &$allowEdit, &$allowDelete, &$mergeWithDefault, &$handled)
        {
    
        }
    
    }

    SetUpUserAuthorization();

    try
    {
        $Page = new greenseeker_analysisPage("greenseeker_analysis", "greenseeker_analysis.php", GetCurrentUserPermissionSetForDataSource("greenseeker analysis"), 'UTF-8');
        $Page->SetRecordPermission(GetCurrentUserRecordPermissionsForDataSource("greenseeker analysis"));
        GetApplication()->SetMainPage($Page);
        GetApplication()->Run();
    }
    catch(Exception $e)
    {
        ShowErrorPage($e);
    }
	
