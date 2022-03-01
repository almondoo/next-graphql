import { DataGrid, GridColDef } from '@mui/x-data-grid';
import styles from './style';
import Box from '@mui/material/Box';
import { Task } from 'models/task';

type Props = {
  tasks: Task[];
};

const columns: GridColDef[] = [
  {
    field: 'id',
    headerName: 'ID',
    width: 70,
    headerAlign: 'center',
    align: 'center',
  },
  {
    field: 'title',
    headerName: 'タイトル',
    width: 130,
  },
  {
    field: 'text',
    headerName: '内容',
    width: 130,
  },
];

const TaskTemplate = ({ tasks }: Props): JSX.Element => {
  return (
    <Box sx={styles.wrap}>
      <DataGrid rows={tasks} columns={columns} pageSize={5} rowsPerPageOptions={[5]} />
    </Box>
  );
};

export default TaskTemplate;
