import { gql } from '@apollo/client';
import type { Task } from 'models/task';

export const UPDATE_TASK_MUTATION = gql`
  mutation UpdateTask($input: UpdateTaskInput!) {
    updateTask(input: $input) {
      id
      title
      text
    }
  }
`;

export interface UpdateTask {
  task: Task;
}
