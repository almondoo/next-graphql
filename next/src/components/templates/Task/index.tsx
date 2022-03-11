import styles from './style';
import type { Task } from 'models/task';
import type { Column, Paginate } from 'models/utils';
import Box from '@mui/material/Box';
import Table from 'components/uiParts/table/index';
import Pagination from '@mui/material/Pagination';
import { useRecoilState } from 'recoil';
import { taskPage } from 'recoil/page/atom';
import { ChangeEvent } from 'react';

type Props = {
  tasks: Task[];
  paginate: Paginate;
  isLoad: boolean;
};

const columns: Column<Task>[] = [
  {
    id: 'id',
    label: 'ID',
    minWidth: 80,
    align: 'center',
  },
  {
    id: 'title',
    label: 'タイトル',
    minWidth: 200,
  },
  {
    id: 'text',
    label: '内容',
    minWidth: 400,
  },
  {
    id: 'user.name',
    label: '作成者',
    minWidth: 170,
    getValue: (row: Task): string => (row.user ? row.user.name : ''),
  },
  {
    id: 'setting',
    label: '編集',
    minWidth: 62,
    align: 'center',
    route: '/task',
  },
];

const TaskTemplate = ({ tasks, paginate, isLoad }: Props): JSX.Element => {
  const [page, setPage] = useRecoilState<number>(taskPage);

  const handleChange = (_: ChangeEvent<unknown>, value: number) => {
    setPage(value);
  };

  return (
    <Box sx={styles.wrap}>
      <Table<Task> rows={tasks} columns={columns} height={800} isLoad={isLoad} />
      <Box mt={2}>
        <Pagination count={paginate.lastPage} page={page} color="primary" variant="outlined" onChange={handleChange} />
      </Box>
    </Box>
  );
};

export default TaskTemplate;
