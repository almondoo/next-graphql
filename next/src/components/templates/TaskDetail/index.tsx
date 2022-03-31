import { useState, FormEvent } from 'react';
import type { Task } from 'models/task';
import type { TaskStatus } from 'models/task_status';
import { KeyboardEvent } from 'react';
import Box from '@mui/material/Box';
import TextField from '@mui/material/TextField';
import Button from '@mui/material/Button';
import Link from 'next/link';
import routes from 'utils/route';
import InputLabel from '@mui/material/InputLabel';
import MenuItem from '@mui/material/MenuItem';
import FormControl from '@mui/material/FormControl';
import Select, { SelectChangeEvent } from '@mui/material/Select';
import CircularProgress from '@mui/material/CircularProgress';
import Alert from '@mui/material/Alert';
import { useMutation } from '@apollo/client';
import { CREATE_TASK_MUTATION, CreateTask } from 'graphql/taskDetail/mutation/createTask';
import { UPDATE_TASK_MUTATION, UpdateTask } from 'graphql/taskDetail/mutation/updateTask';

type Props = {
  task?: Task;
  task_statuses: TaskStatus[];
};

const TaskDetail = ({ task, task_statuses }: Props): JSX.Element => {
  const [status, setStatus] = useState<number>(1);
  const [saveTask, { data, loading, error }] = useMutation<CreateTask | UpdateTask>(
    task ? UPDATE_TASK_MUTATION : CREATE_TASK_MUTATION,
  );

  const handleChange = (event: SelectChangeEvent) => {
    setStatus(Number(event.target.value));
  };

  const handleSubmit = (event: FormEvent<HTMLFormElement>) => {
    event.preventDefault();
    const data = new FormData(event.currentTarget);
    console.log({
      title: data.get('title'),
      text: data.get('text'),
    });
    saveTask({
      variables: {
        input: {
          title: data.get('title'),
          text: data.get('text'),
        },
      },
    });
  };

  return (
    <Box p={3}>
      <Box component="form" onSubmit={handleSubmit} noValidate>
        {data && <Alert severity="success">保存に成功しました。</Alert>}
        {error && <Alert severity="error">保存に失敗しました。</Alert>}
        {task && (
          <>
            <TextField
              margin="normal"
              required
              id="id"
              label="ID"
              name="id"
              value={task ? task.id : ''}
              autoComplete="id"
              disabled
            />
            <Box sx={{ minWidth: 120 }} mt={2} mb={1}>
              <FormControl>
                <InputLabel id="status-select">ステータス</InputLabel>
                <Select
                  labelId="status-select"
                  id="demo-simple-select"
                  value={status.toString()}
                  label="status"
                  onChange={handleChange}
                >
                  {task_statuses.map((v) => (
                    <MenuItem key={v.id} value={v.id}>
                      {v.status}
                    </MenuItem>
                  ))}
                </Select>
              </FormControl>
            </Box>
          </>
        )}
        <TextField
          margin="normal"
          required
          fullWidth
          id="title"
          label="タイトル"
          name="title"
          defaultValue={task ? task.title : ''}
          autoComplete="title"
          autoFocus
          onKeyPress={(e: KeyboardEvent<HTMLInputElement>) => {
            if (e.key === 'Enter') e.preventDefault();
          }}
        />
        <TextField
          margin="normal"
          required
          fullWidth
          id="text"
          name="text"
          defaultValue={task ? task.text : ''}
          label="内容"
          type="text"
          rows="10"
          multiline
          autoComplete="text"
        />
        <Box sx={{ display: 'flex', justifyContent: 'flex-end' }} m={2}>
          <Link href={routes.taskList} passHref>
            <Button variant="outlined">戻る</Button>
          </Link>
          {!loading ? (
            <Button type="submit" variant="contained" sx={{ ml: 2 }}>
              {task ? '更新' : '作成'}
            </Button>
          ) : (
            <Button variant="contained" sx={{ ml: 2 }} color="primary" size="large">
              <CircularProgress size={30} sx={{ color: 'white' }} />
            </Button>
          )}
        </Box>
      </Box>
    </Box>
  );
};

export default TaskDetail;
